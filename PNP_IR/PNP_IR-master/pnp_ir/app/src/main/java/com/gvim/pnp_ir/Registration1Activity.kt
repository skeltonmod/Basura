package com.gvim.pnp_ir

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import com.gvim.pnp_ir.R.layout.activity_registration1
import kotlinx.android.synthetic.main.activity_registration1.*

class Registration1Activity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(activity_registration1)
        val context = this
        var utils = Utility()
        button_next.setOnClickListener {
            var fname: String = editText_firstname.text.toString()
            var lname: String = editText_lastname.text.toString()
            var suffix: String = editText_suffix.text.toString()
            var middlename: String = editText_middlename.text.toString()
            var nickname: String = editText_nickname.text.toString()
            var citizenship: String = editText_citizenship.text.toString()
            var civilStatus: String = spinner2.selectedItem.toString()
            var dob: String = editText_dateOfBirth.text.toString()
            var mobilenumber: String = editText_mobileNumber.text.toString()
            var email: String = editText_email.text.toString()
            var pob: String = editText_placeOfBirth.text.toString()
            var education: String = editText_highestEducAttainment.text.toString()

            var gender = ""

            if(radioButton_male.isChecked == true){
                gender = "Male"

            }else if(radioButton_female.isChecked == true){
                gender = "Female"
            }

            if(editText_firstname.text.toString().length > 0 && editText_lastname.text.toString().length > 0){

                Log.i("Registration 1",fname)
                Log.i("Registration 1",lname)
                Log.i("Registration 1",suffix)
                Log.i("Registration 1",middlename)
                Log.i("Registration 1",nickname)
                Log.i("Registration 1",citizenship)
                Log.i("Registration 1",dob)
                Log.i("Registration 1",gender)
                Log.i("Registration 1",civilStatus)
                Log.i("Registration 1",mobilenumber)
                Log.i("Registration 1",email)
                Log.i("Registration 1",pob)
                Log.i("Registration 1",education)


            }else{
                utils.showResult("Important Fields need to be fill in!",context)
            }

            val i = Intent(this, Registration2Activity::class.java)
            i.putExtra("firstname",fname)
            i.putExtra("lastname",lname)
            i.putExtra("suffix",suffix)
            i.putExtra("middlename",middlename)
            i.putExtra("nickname",nickname)
            i.putExtra("citizenship",citizenship)
            i.putExtra("dob",dob)
            i.putExtra("gender",gender)
            i.putExtra("civilStatus",civilStatus)
            i.putExtra("mobilenumber",mobilenumber)
            i.putExtra("email",email)
            i.putExtra("pob",pob)
            i.putExtra("education",education)
            startActivity(i)


        }
    }

}

