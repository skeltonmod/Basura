package com.gvim.pnp_ir.service

object URLs {
    private val ROOT_URL = "http://10.0.2.2/phpREST/API.php?apicall="

    val URL_REGISTER = ROOT_URL + "signup"
    val URL_REGISTER_EXTRA = ROOT_URL + "signupextra"
    val URL_LOGIN = ROOT_URL + "login"
    val URL_SEND_REPORT = ROOT_URL + "sendreport"
    val URL_GET_INCIDENT = ROOT_URL + "getincident"
}
