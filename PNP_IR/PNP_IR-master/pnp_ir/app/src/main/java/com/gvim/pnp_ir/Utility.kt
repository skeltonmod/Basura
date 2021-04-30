package com.gvim.pnp_ir

import android.content.Context
import android.widget.Toast

class Utility {
    public fun showResult(message: String?,context:Context) {
        Toast.makeText(context, message, Toast.LENGTH_SHORT).show()
    }
}