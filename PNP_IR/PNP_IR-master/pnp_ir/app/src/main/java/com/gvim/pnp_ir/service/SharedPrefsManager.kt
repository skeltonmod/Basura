package com.gvim.pnp_ir.service

import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import com.gvim.pnp_ir.MainActivity

class SharedPrefsManager private constructor(context: Context) {

    //this method will checker whether user is already logged in or not
    val isLoggedIn: Boolean
        get() {
            val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
            return sharedPreferences?.getString(KEY_USERNAME, null) != null
        }

    //this method will give the logged in user
    val user: Login
        get() {
            val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
            return Login(
                sharedPreferences!!.getInt(KEY_ID, -1),
                sharedPreferences.getString(KEY_USERNAME, null),
                sharedPreferences.getString(KEY_EMAIL, null)
            )
        }

    init {
        mCtx = context
    }

    //method to let the user login
    //this method will store the user data in shared preferences
    fun userLogin(user: DataModel) {
        val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
        val editor = sharedPreferences?.edit()
        editor?.putInt(KEY_ID, user.id)
        editor?.putString(KEY_USERNAME, user.firstname)
        editor?.putString(KEY_EMAIL, user.email)
        editor?.apply()
    }

    fun login(user: LoginModel) {
        val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
        val editor = sharedPreferences?.edit()
        editor?.putInt(KEY_ID, user.id)
        editor?.putString(KEY_USERNAME, user.firstname)
        editor?.putString(KEY_PASSWORD, user.password)
        editor?.apply()
    }

    fun incident(user: IncidentModel) {
        val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
        val editor = sharedPreferences?.edit()
        editor?.putInt(KEY_ID, user.id)
        editor?.putString(KEY_USERNAME, user.image)
        editor?.putString(KEY_PASSWORD, user.status)
        editor?.apply()
    }
    //this method will logout the user
    fun logout() {
        val sharedPreferences = mCtx?.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE)
        val editor = sharedPreferences?.edit()
        editor?.clear()
        editor?.apply()
        mCtx?.startActivity(Intent(mCtx, MainActivity::class.java))
    }

    companion object {
        //the constants
        private val SHARED_PREF_NAME = "sharedprefs"
        private val KEY_USERNAME = "keyusername"
        private val KEY_EMAIL = "keyemail"
        private val KEY_PASSWORD = "keypassword"
        private val KEY_ID = "keyid"
        private var mInstance: SharedPrefsManager? = null
        private var mCtx: Context? = null

        @Synchronized
        fun getInstance(context: Context): SharedPrefsManager {
            if (mInstance == null) {
                mInstance = SharedPrefsManager(context)
            }
            return mInstance as SharedPrefsManager
        }
    }

}
