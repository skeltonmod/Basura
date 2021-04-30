package com.gvim.pnp_ir

import android.os.Bundle
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.gvim.pnp_ir.service.GetIncidentModel
import com.gvim.pnp_ir.service.URLs
import org.json.JSONArray
import org.json.JSONException
import org.json.JSONObject


class GetIncidentActivity : AppCompatActivity() {
    var incidentList: MutableList<GetIncidentModel> = ArrayList()
    val utils = Utility()
    override fun onCreate(savedInstanceState: Bundle?){
       super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_getincident)


        getIncident()
    }

    private fun getIncident(){

        val recycler = findViewById<RecyclerView>(R.id.recyclerView)
        recycler.layoutManager = LinearLayoutManager(this,RecyclerView.VERTICAL,false)
        val incidents = ArrayList<GetIncidentModel>()

        val stringRequest = object: StringRequest(Request.Method.POST,URLs.URL_GET_INCIDENT,
            Response.Listener {
                response->try{
                var array: JSONArray = JSONArray(response)
                for (i in 0 until array.length()) {
                    //getting incident object from json array
                    val product: JSONObject = array.getJSONObject(i)

                    incidents.add(
                        GetIncidentModel(
                            product.getInt("id"),
                            product.getString("image"),
                            product.getString("incidenttype"),
                            product.getString("date"),
                            product.getString("time"),
                            product.getString("status")
                    )
                    )
                }
                val adapter = CustomAdapter(incidents)
                recycler.adapter = adapter
                utils.showResult(adapter.getItemCount().toString(),this)
            }catch(e:JSONException){
                e.printStackTrace()
            }
            },
            Response.ErrorListener {error ->utils.showResult(error.message,this)}){
        }
        Volley.newRequestQueue(this).add(stringRequest)
    }

}