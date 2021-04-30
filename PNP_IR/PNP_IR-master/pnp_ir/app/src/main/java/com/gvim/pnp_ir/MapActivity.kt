package com.gvim.pnp_ir

import android.Manifest
import android.annotation.SuppressLint
import android.app.Activity
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Color
import android.location.Address
import android.location.Geocoder
import android.location.Location
import android.location.LocationManager
import android.os.Bundle
import android.os.Looper
import android.provider.Settings
import android.util.Log
import android.widget.EditText
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import com.cocoahero.android.geojson.Position
import com.google.android.gms.location.*
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.CameraPosition
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.gms.maps.model.MarkerOptions
import com.google.maps.android.data.geojson.GeoJsonGeometryCollection
import com.google.maps.android.data.geojson.GeoJsonLayer
import com.google.maps.android.data.geojson.GeoJsonPolygon
import com.google.maps.android.data.geojson.GeoJsonPolygonStyle
import java.io.IOException
import java.util.*


class MapActivity: AppCompatActivity(), OnMapReadyCallback, GoogleMap.OnMarkerDragListener {
    private lateinit var mMap: GoogleMap
     var glatitude: Double = 0.0
     var glongitude: Double = 0.0


    override fun onCreate(savedInstanceState: Bundle?){
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_maps)
        var intent: Intent = getIntent()
        glatitude = intent.getDoubleExtra("latitude",0.0)
        glongitude = intent.getDoubleExtra("longitude",0.0)

        val mapFragment = supportFragmentManager
            .findFragmentById(R.id.map) as SupportMapFragment
        mapFragment.getMapAsync(this)
    }
    override fun onMapReady(googleMap: GoogleMap){
        mMap = googleMap
        mMap.setMapType(GoogleMap.MAP_TYPE_HYBRID)
        mMap.setOnMarkerDragListener(this)
        // Add a marker and move the camera

        val position = LatLng(glatitude, glongitude)
        var marker = mMap.addMarker(MarkerOptions().draggable(true).position(position))
        val cameraPosition = CameraPosition.Builder().target(position).zoom(18.5f).bearing(70f).tilt(25f).build()
        mMap.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition))
        //glatitude = position.latitude
        //glongitude = position.longitude
        try{
            var layer: GeoJsonLayer = GeoJsonLayer(mMap,R.raw.map,this)
            var polystyle: GeoJsonPolygonStyle = layer.defaultPolygonStyle
            polystyle.setStrokeColor(Color.BLACK)
            polystyle.setStrokeWidth(5.0F)
            layer.addLayerToMap()

            layer.setOnFeatureClickListener { feature ->
                Toast.makeText(
                    this,
                    "Feature clicked: $glatitude/$glongitude  at " + feature.getProperty("NAME_3") ,
                    Toast.LENGTH_SHORT
                ).show()
                var resultIntent: Intent = Intent()
                resultIntent.putExtra("result",feature.getProperty("NAME_3"))
                setResult(Activity.RESULT_OK,resultIntent)
                finish()
            }
        }catch(e: IOException){
            Log.e("ERROR",e.toString())
        }

    }
    private fun addGeoJsonLayerToMap(layer: GeoJsonLayer) {
        layer.addLayerToMap()
        // Demonstrate receiving features via GeoJsonLayer clicks.

    }

    override fun onMarkerDragEnd(marker: Marker) {
        var lat = marker.position.latitude
        var long = marker.position.longitude
        var layer: GeoJsonLayer = GeoJsonLayer(mMap,R.raw.map,this)
        glatitude = lat
        glongitude = long
        Toast.makeText(
            this,
            "Marker clicked (Global Values): $glatitude $glongitude",
            Toast.LENGTH_SHORT
        ).show()



    }

    override fun onMarkerDragStart(marker: Marker) {
    }

    override fun onMarkerDrag(marker: Marker) {

    }

}