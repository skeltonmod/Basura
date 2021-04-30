package com.gvim.pnp_ir

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import kotlinx.android.synthetic.main.activity_home.*

class HomeActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_home)
        val getFname: String? = intent.getStringExtra("firstname")
        val firstnameString: String? = getFname
        textView_name.setText(firstnameString)
        val incident = findViewById<Button>(R.id.btn_SendIncident)
        val fetchInicdent = findViewById<Button>(R.id.btn_IncidentStatus)
        incident.setOnClickListener{
            val i = Intent(this, IncidentActivity::class.java)
            i.putExtra("fname",firstnameString)
            startActivity(i)
        }
        fetchInicdent.setOnClickListener{
            val i = Intent(this, GetIncidentActivity::class.java)
            startActivity(i)
        }

    }
}
