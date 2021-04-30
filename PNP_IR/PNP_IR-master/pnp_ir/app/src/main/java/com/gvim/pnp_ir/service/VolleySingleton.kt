package com.gvim.pnp_ir.service
import android.content.Context
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.toolbox.Volley


class VolleySingleton private constructor(context: Context){
    private var mRequestQueue: RequestQueue
    init {
        mCtx = context
        mRequestQueue = requestQueue
    }

    val requestQueue: RequestQueue
        get() {
            if (mRequestQueue == null) {

                mRequestQueue = Volley.newRequestQueue(mCtx?.applicationContext)
            }
            return mRequestQueue
        }

    fun <T> addToRequestQueue(req: Request<T>) {
        requestQueue.add(req)
    }

    companion object {
        private var mInstance: VolleySingleton? = null
        private var mCtx: Context? = null

        @Synchronized
        fun getInstance(context: Context): VolleySingleton {
            if (mInstance == null) {
                mInstance = VolleySingleton(context)
            }
            return mInstance as VolleySingleton
        }
    }
}