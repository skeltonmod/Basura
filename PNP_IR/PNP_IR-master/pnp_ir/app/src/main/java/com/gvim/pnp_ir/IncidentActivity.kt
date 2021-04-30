package com.gvim.pnp_ir
import android.Manifest
import android.annotation.SuppressLint
import android.app.Activity
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.location.*
import android.net.Uri
import android.os.Build
import android.os.Bundle
import android.provider.Settings
import android.provider.Settings.ACTION_APPLICATION_DETAILS_SETTINGS
import android.util.Log
import android.widget.Button
import android.widget.ImageView
import android.widget.Spinner
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import com.android.volley.AuthFailureError
import com.android.volley.Response
import com.android.volley.toolbox.Volley
import com.gvim.pnp_ir.service.*
import kotlinx.android.synthetic.main.activity_home.*
import kotlinx.android.synthetic.main.activity_incident.*
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException
import java.text.SimpleDateFormat
import android.location.Geocoder
import android.location.Address
import android.os.Looper
import android.widget.EditText
import com.google.android.gms.location.*
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.model.LatLng
import com.google.maps.android.data.geojson.GeoJsonLayer
import com.google.maps.android.data.geojson.GeoJsonPoint
import java.lang.Double.parseDouble
import java.util.*
import kotlin.collections.HashMap

private const val PERMISSION_REQUEST = 10
class IncidentActivity: AppCompatActivity() {
    private var imageData: ByteArray? = null
    private lateinit var imageButton: ImageView
    companion object {
        private const val IMAGE_PICK_CODE = 999
    }

    var utils = Utility()
    lateinit var mFusedLocationClient: FusedLocationProviderClient
    //private lateinit var mMap: GoogleMap
    override fun onCreate(savedInstanceState: Bundle?){
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_incident)
        imageButton = findViewById(R.id.imageView3)
        val sendReport = findViewById<Button>(R.id.button_sendReport)
        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this)
        getLastLocation()

        var time: Date = Calendar.getInstance().getTime()
        var df: SimpleDateFormat = SimpleDateFormat("dd-MM-yyyy")
        var dt: SimpleDateFormat = SimpleDateFormat("HH:mm z")
        var formattedDate:String = df.format(time)
        var formattedTime:String = dt.format(time)




        editText_date.setText(formattedDate)
        editText_time.setText(formattedTime)
        imageButton.setOnClickListener{
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.READ_EXTERNAL_STORAGE)
                != PackageManager.PERMISSION_GRANTED) {
                // Permission is not granted
                utils.showResult("Permission not granted", this)
                if (ActivityCompat.shouldShowRequestPermissionRationale(this,
                        Manifest.permission.READ_EXTERNAL_STORAGE)) {

                } else {
                    ActivityCompat.requestPermissions(this,
                        arrayOf(Manifest.permission.READ_EXTERNAL_STORAGE),
                        1)

                }
            }else{
                openGallery()
            }

        }
        button_sendReport2.setOnClickListener(){
            getBarangay()

        }
        button_sendReport.setOnClickListener{
            sendIncident()
        }

    }

    private fun getBarangay(){
        val i: Int = 38
        val intent = Intent(this,MapActivity::class.java)
        var getlat:String = editText_latlong.text.toString()
        var getlong:String = editText_latlong2.text.toString()
        var lat = getlat.toDouble()
        var long = getlong.toDouble()
        intent.putExtra("latitude", lat)
        intent.putExtra("longitude",long)
        startActivityForResult(intent,i)
    }
    private fun openGallery(){
        val intent = Intent(Intent.ACTION_PICK)
        intent.type = "image/*"
        startActivityForResult(intent, IMAGE_PICK_CODE)
    }

    private fun sendIncident() {
        imageData?: return
        val request = object : VolleyFileUploadRequest(
            Method.POST,
            URLs.URL_SEND_REPORT,
            Response.Listener{
                response -> try{
                Log.i("JSON Response", "Yo")
            }catch (e: JSONException){
                e.printStackTrace()
                Log.i("Exception", e.toString())
            }

            },
            Response.ErrorListener {
                error -> utils.showResult(error.message,this)
            }
        ) {

            @Throws(AuthFailureError::class)
            override  fun getParams(): Map<String, String> {

                val params = HashMap<String, String>()
                var informanttype:String = ""
                if(radioButton_victim.isChecked){
                    informanttype = "Victim"
                }else if(radioButton_informant.isChecked == true){
                    informanttype = "Informant"
                }
                var spinner: Spinner = findViewById<Spinner>(R.id.spinner)
                var incidenttype: String = spinner.selectedItem.toString()
                var getFname: String? = intent.getStringExtra("fname")
                params["incidenttype"] = incidenttype
                params["informanttype"] = informanttype
                params["date"] = editText_date.getText().toString()
                params["time"] = editText_time.getText().toString()
                params["latitude"] = editText_latlong.getText().toString()
                params["longitude"] = editText_latlong2.getText().toString()
                params["city"] = editText_citystreet.getText().toString()
                params["street"] = editText_citystreet.getText().toString()
                params["informantname"] = getFname.toString()
                params["status"] = "Pending"
                params["station"] = ""
                params["informantid"] = "1"
                return params
            }


            @Throws(AuthFailureError::class)
            override fun getByteData(): MutableMap<String, FileDataPart> {
                var params = HashMap<String, FileDataPart>()
                var imageName: Long = System.currentTimeMillis()
                params["image"] = FileDataPart("$imageName.png", imageData!!, "jpeg")
                return params
            }
        }
        Volley.newRequestQueue(this).add(request);
    }

    @Throws(IOException::class)
    private fun createImageData(uri: Uri) {
        val inputStream = contentResolver.openInputStream(uri)
        inputStream?.buffered()?.use {
            imageData = it.readBytes()
        }
    }
    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (resultCode == Activity.RESULT_OK && requestCode == IMAGE_PICK_CODE ) {
            val uri = data?.data
            if (uri != null) {
                imageButton.setImageURI(uri)
                createImageData(uri)
            }
        }

        if(requestCode == 38){
            if(resultCode == Activity.RESULT_OK){
                var result: String = data!!.getStringExtra("result")
                editText_citystreet.setText(result)
            }

        }

    }

    private fun checkPermissions(): Boolean {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED &&
            ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED){
            return true
        }
        return false
    }
    private fun requestPermissions() {
        ActivityCompat.requestPermissions(
            this,
            arrayOf(Manifest.permission.ACCESS_COARSE_LOCATION, Manifest.permission.ACCESS_FINE_LOCATION),
            42
        )
    }
    override fun onRequestPermissionsResult(requestCode: Int, permissions: Array<String>, grantResults: IntArray) {
        if (requestCode == 42) {
            if ((grantResults.isNotEmpty() && grantResults[0] == PackageManager.PERMISSION_GRANTED)) {
                // Granted. Start getting the location information
            }
        }
    }
    private fun isLocationEnabled(): Boolean {
        var locationManager: LocationManager = getSystemService(Context.LOCATION_SERVICE) as LocationManager
        return locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER) || locationManager.isProviderEnabled(
            LocationManager.NETWORK_PROVIDER
        )
    }

    @SuppressLint("MissingPermission")
    private fun getLastLocation() {

            //var getlat:String = findViewById<EditText>(R.id.editText_latlong).toString()
            //var getlong:String = findViewById<EditText>(R.id.editText_latlong2).toString()
            //var lat: Double = getlat.toDouble()
            //var long: Double = getlong.toDouble()

            //
            //var cityName: String = address.get(0).getAddressLine(0)



        if (checkPermissions()) {
            if (isLocationEnabled()) {

                mFusedLocationClient.lastLocation.addOnCompleteListener(this) { task ->
                    var location: Location? = task.result
                    var geocoder: Geocoder = Geocoder(this,Locale.getDefault())

                    if (location == null) {
                        requestNewLocationData()

                    } else {
                        var address: List<Address> = geocoder.getFromLocation(location!!.latitude,location.longitude,1)
                        var cityname: String = "FOOBAR!"
                        //var street: String = address.get(1).getAddressLine(1)
                        findViewById<EditText>(R.id.editText_latlong).setText(location.latitude.toString())
                        findViewById<EditText>(R.id.editText_latlong2).setText(location.longitude.toString())
                        findViewById<EditText>(R.id.editText_citystreet).setText(cityname)
                    }
                }
            } else {
                utils.showResult("Turn on Location",this)
                val intent = Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS)
                startActivity(intent)
            }
        } else {
            requestPermissions()
        }
    }
    @SuppressLint("MissingPermission")
    private fun requestNewLocationData() {
        var mLocationRequest = LocationRequest()
        mLocationRequest.priority = LocationRequest.PRIORITY_HIGH_ACCURACY
        mLocationRequest.interval = 0
        mLocationRequest.fastestInterval = 0
        mLocationRequest.numUpdates = 1

        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this)
        mFusedLocationClient!!.requestLocationUpdates(
            mLocationRequest, mLocationCallback,
            Looper.myLooper()
        )
    }
    private val mLocationCallback = object : LocationCallback() {
        override fun onLocationResult(locationResult: LocationResult) {
            var mLastLocation: Location = locationResult.lastLocation
            findViewById<EditText>(R.id.editText_latlong).setText(mLastLocation.latitude.toString())
            findViewById<EditText>(R.id.editText_latlong2).setText(mLastLocation.longitude.toString())
        }
    }

}