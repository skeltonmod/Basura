package com.gvim.pnp_ir

import android.Manifest
import android.app.Activity
import android.content.Intent
import android.content.pm.PackageManager
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle

import android.util.Log
import android.widget.ImageView
import android.widget.Spinner
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import com.android.volley.AuthFailureError
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.gvim.pnp_ir.service.*
import kotlinx.android.synthetic.main.activity_incident.*
import kotlinx.android.synthetic.main.activity_main.*

import kotlinx.android.synthetic.main.activity_registration2.*
import org.json.JSONException
import org.json.JSONObject
import java.io.IOException


class Registration2Activity : AppCompatActivity() {
    private var imageData: ByteArray? = null
    private lateinit var imageView: ImageView
    var utils = Utility()
    var getInt: Int = 0
    var proceed: Boolean = false
    companion object {
        private const val IMAGE_PICK_CODE = 999
    }
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.activity_registration2)
        imageView = findViewById(R.id.imageView5)
        val context = this
        val intent = intent
        val getFname: String = intent.getStringExtra("firstname")
        val getLname:String = intent.getStringExtra("lastname")
        val getsuffix:String = intent.getStringExtra("suffix")
        val getMname:String = intent.getStringExtra("middlename")
        val getNname:String = intent.getStringExtra("nickname")
        val getcitizenship:String = intent.getStringExtra("citizenship")
        val getdob:String = intent.getStringExtra("dob")
        val getgender:String = intent.getStringExtra("gender")
        val getcivilstatus:String = intent.getStringExtra("civilStatus")
        val getmobilenumber:String = intent.getStringExtra("mobilenumber")
        val getemail:String = intent.getStringExtra("email")
        val getpob:String = intent.getStringExtra("pob")
        val geteduc:String = intent.getStringExtra("education")
        button_save.setOnClickListener(){
            //debug information
            Log.i("Registration 2", getFname)
            Log.i("Registration 2", getLname)
            Log.i("Registration 2", getsuffix)
            Log.i("Registration 2", getMname)
            Log.i("Registration 2", getNname)
            Log.i("Registration 2", getcitizenship)
            Log.i("Registration 2", getdob)
            Log.i("Registration 2", getgender)
            Log.i("Registration 2", getcivilstatus)
            Log.i("Registration 2", getmobilenumber)
            Log.i("Registration 2", getemail)
            Log.i("Registration 2", getpob)
            Log.i("Registration 2", geteduc)
            register()
            //utils.showResult("Successfully Added $getFname",this)
        }

        imageView.setOnClickListener(){
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
    }
    private fun openGallery(){
        val intent = Intent(Intent.ACTION_PICK)
        intent.type = "image/*"
        startActivityForResult(intent, IMAGE_PICK_CODE)
    }
    @Throws(IOException::class)
    private fun createImageData(uri: Uri) {
        val inputStream = contentResolver.openInputStream(uri)
        inputStream?.buffered()?.use {
            imageData = it.readBytes()
        }
    }
    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        if (resultCode == Activity.RESULT_OK && requestCode == IMAGE_PICK_CODE) {
            val uri = data?.data
            if (uri != null) {
                imageView.setImageURI(uri)
                createImageData(uri)
            }
        }
        super.onActivityResult(requestCode, resultCode, data)
    }

    private fun register() {

        val intent = intent
        val getFname: String = intent.getStringExtra("firstname")
        val getLname:String = intent.getStringExtra("lastname")
        val getsuffix:String = intent.getStringExtra("suffix")
        val getMname:String = intent.getStringExtra("middlename")
        val getNname:String = intent.getStringExtra("nickname")
        val getcitizenship:String = intent.getStringExtra("citizenship")
        val getdob:String = intent.getStringExtra("dob")
        val getgender:String = intent.getStringExtra("gender")
        val getcivilstatus:String = intent.getStringExtra("civilStatus")
        val getmobilenumber:String = intent.getStringExtra("mobilenumber")
        val getemail:String = intent.getStringExtra("email")
        val getpob:String = intent.getStringExtra("pob")
        val geteduc:String = intent.getStringExtra("education")
        val currentaddress:String = editText_cAddress.getText().toString() + " " +editText_cBarangay.getText().toString()+ " " + editText_cCity.getText().toString()
        val homeaddress: String = editText_hAddress.getText().toString() + " " + editText_hBarangay.getText().toString()+ " " + editText_hCity.getText().toString()
        val getoccupation:String = editText_occupation.getText().toString()
        val workaddress:String = editText_wAddress.getText().toString()
        val stringRequest = object : StringRequest(Request.Method.POST, URLs.URL_REGISTER, Response.Listener { response ->
                //progressBar.visibility = View.GONE

                try {

                    //converting response to json object
                    val obj = JSONObject(response)
                    //if no error in response

                    if (!obj.getBoolean("error")) {
                        utils.showResult(obj.getString("message"),this)

                        //getting the user from the response
                        val userJson = obj.getJSONObject("user")

                        //creating a new user object
                        val user = DataModel(
                            userJson.getInt("id"),
                            userJson.getString("firstname"),
                            userJson.getString("email"),
                            userJson.getString("password")
                        )
                        getInt = userJson.getInt("id")
                        //storing the user in shared preferences
                        SharedPrefsManager.getInstance(applicationContext).userLogin(user)

                        //starting the MainActivity activity
                        if(!obj.getBoolean("error")){
                            subRegister()
                            finish()
                            startActivity(Intent(applicationContext, MainActivity::class.java))
                        }
                    } else {
                        utils.showResult(obj.getString("message"),this)
                    }
                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            }, Response.ErrorListener { error ->
                utils.showResult(error.message,this)
            }) {
            @Throws(AuthFailureError::class)
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                params["firstname"] = getFname
                params["suffix"] = getsuffix
                params["lastname"] = getLname
                params["middlename"] = getMname
                params["email"] = getemail
                params["password"] = editText_Pass.getText().toString()
                params["citizenship"] = getcitizenship
                params["civilstatus"] = getcivilstatus
                params["dob"] = getdob
                params["educ"] = geteduc
                params["gender"] = getgender
                params["mobilenumber"] = getmobilenumber
                params["nickname"] = getNname
                params["pob"] = getpob
                params["currentaddress"] = currentaddress
                params["homeaddress"] = homeaddress
                params["occupation"] = getoccupation
                params["workaddress"] = workaddress
                return params
            }

        }
        Volley.newRequestQueue(this).add(stringRequest)

    }
    private fun subRegister(){
        imageData?: return
        val request = object : VolleyFileUploadRequest(
            Method.POST,
            URLs.URL_REGISTER_EXTRA,
            Response.Listener{
                    response -> try{
                Log.i("JSON Response", "Yo")
            }catch (e: JSONException){e.printStackTrace()}

            },
            Response.ErrorListener {
                    error -> utils.showResult(error.message,this)
            }
        ) {

            @Throws(AuthFailureError::class)
            override  fun getParams(): Map<String, String> {

                val params = HashMap<String, String>()
                params["informant_id"] = getInt.toString()
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
    }


