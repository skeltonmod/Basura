package com.gvim.pnp_ir

import android.graphics.Color
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.LinearLayout
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.gvim.pnp_ir.service.GetIncidentModel
import kotlinx.android.synthetic.main.incident_view.view.*

class CustomAdapter(val lists: ArrayList<GetIncidentModel>): RecyclerView.Adapter<CustomAdapter.ViewHolder>() {
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val v = LayoutInflater.from(parent.context).inflate(R.layout.incident_view,parent, false)
        return ViewHolder(v)
    }

    override fun getItemCount(): Int {

        return lists.size
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.bindItems(lists[position])
        var row_index: Int = position
        if((row_index % 2 == 0)){
            holder.row_linearlayout.setBackgroundColor(Color.parseColor("#FFFDFD"))
        }else{
            holder.row_linearlayout.setBackgroundColor(Color.parseColor("#F8F7F7"))
        }
    }



    class ViewHolder(itemView: View): RecyclerView.ViewHolder(itemView){
        val row_linearlayout = itemView.findViewById<LinearLayout>(R.id.linearlayout)
        fun bindItems(incident: GetIncidentModel){
            var holder: ViewHolder

            val image = itemView.findViewById<ImageView>(R.id.thumbnail)
            val incidenttype = itemView.findViewById<TextView>(R.id.incidenttype)
            val time = itemView.findViewById<TextView>(R.id.time)
            val date = itemView.findViewById<TextView>(R.id.date)
            val status = itemView.findViewById<TextView>(R.id.status)

            Glide.with(image.context).load(incident.image).into(image.thumbnail)
            incidenttype.text = incident.incidenttype
            time.text = incident.time
            date.text = incident.date
            status.text = incident.status
        }
    }
}