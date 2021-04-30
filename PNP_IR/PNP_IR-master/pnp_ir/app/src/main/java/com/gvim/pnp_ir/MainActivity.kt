package com.gvim.pnp_ir

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.widget.Button
import android.widget.TextView
import org.json.JSONException
import org.json.JSONObject
import com.android.volley.AuthFailureError
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.gvim.pnp_ir.service.*
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity() {
    var utils = Utility()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        var btnLogin = findViewById<Button>(R.id.btnLogin)
        var textViewNewAccount = findViewById<TextView>(R.id.textView_newAccount)
        btnLogin.setOnClickListener{
            //do some stuff here

            if(editText_Username.text.toString() == "" && editText_password.text.toString() == ""){
               utils.showResult("Empty Fields",this)
            }else{
                login()
                //var newIntent = Intent(this, HomeActivity::class.java)
                //startActivity(newIntent)
            }

        }

        //when the text view new account is click execute here
        textViewNewAccount.setOnClickListener {
            var newIntent = Intent(this, Registration1Activity::class.java)
            startActivity(newIntent)
        }


    }
    private fun login(){
        val username = editText_Username.text.toString()
        val password = editText_password.text.toString()
        val i = Intent(this, HomeActivity::class.java)
        var globals = Globals()
        Log.i("Login",username)
        Log.i("Login",password)

        val stringRequest = object : StringRequest(Request.Method.POST, URLs.URL_LOGIN,
            Response.Listener { response ->

                try {
                    //converting response to json object
                    val obj = JSONObject(response)

                    //if no error in response
                    if (!obj.getBoolean("error")) {
                        utils.showResult( obj.getString("message"),this)

                        //getting the user from the response
                        val userJson = obj.getJSONObject("user")
                        var firstname: String = userJson.optString("firstname")


                        //creating a new user object
                        val user = LoginModel(
                            userJson.getInt("id"),
                            userJson.getString("firstname"),
                            userJson.getString("email")
                        )
                        Log.i("JSON",userJson.getInt("id").toString())
                        Log.i("JSON",userJson.getString("firstname"))
                        Log.i("JSON",userJson.getString("email"))
                        //storing the user in shared preferences
                        SharedPrefsManager.getInstance(applicationContext).login(user)
                        //starting the MainActivity
                        finish()
                        i.putExtra("firstname",userJson.getString("firstname"))
                        startActivity(i)
                    } else {
                        utils.showResult(obj.getString("message"),this)
                    }
                } catch (e: JSONException) {
                    e.printStackTrace()
                }
            },
            Response.ErrorListener { error ->utils.showResult(error.message,this) }) {
            @Throws(AuthFailureError::class)
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                params["firstname"] = username
                params["password"] = password
                return params
            }
        }
        VolleySingleton.getInstance(this).addToRequestQueue(stringRequest)
    }
}
