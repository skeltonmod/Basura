from tkinter import *
from PIL import ImageTk, Image
import MainMenu


class About(Frame):
    def __init__(self, master):
        Frame.__init__(self, master)
        self.bg = ImageTk.PhotoImage(Image.open("creators.png", 'r'))
        self.my_label = Label(self, image=self.bg).pack(side="top", fill="x")
        self.Main_text = Label(self, text="Creators:", font=("GiambattistaDueMille", 15, "italic", "underline"),
                               fg="black",
                               bg="#c0c0c0").place(x=50, y=117)
        self.Reference_text = Label(self, text="References:",
                                    font=("GiambattistaDueMille", 15, "italic", "underline"), fg="black",
                                    bg="#c0c0c0").place(x=310, y=223)
        self.Prof_text = Label(self, text="Sir Engr. Jonathan Taylar",
                               font=("VCR OSD Mono", 10, "italic", "underline"), fg="black",
                               bg="#c0c0c0").place(x=310, y=255)
        self.YT_text = Label(self, text="Codemy's Youtube Channel", font=("VCR OSD Mono", 10, "italic", "underline"),
                             fg="black",
                             bg="#c0c0c0").place(x=530, y=255)
        self.DaFriend_text = Label(self, text="Elijah Abgao", font=("VCR OSD Mono", 10, "italic", "underline"), #yuuhh Let's Gooo
                             fg="black",
                             bg="#c0c0c0").place(x=530, y=285)
        self.Members_text = Label(self, text="Issa Victoria Peñas", font=("VCR OSD Mono", 10, "italic", "underline"),
                                  fg="black",
                                  bg="#c0c0c0").place(x=50, y=150)
        self.Members_text = Label(self, text="Kenny Delos Reyes", font=("VCR OSD Mono", 10, "italic", "underline"),
                                  fg="black",
                                  bg="#c0c0c0").place(x=220, y=150)
        self.Members_text = Label(self, text="Ryan Paningbatan", font=("VCR OSD Mono", 10, "italic", "underline"),
                                  fg="black",
                                  bg="#c0c0c0").place(x=50, y=180)
        self.Dabutton_picture = PhotoImage(file="Close.png")
        self.Dabutton = Button(self, image=self.Dabutton_picture, command=lambda: self.master.switch_frame(MainMenu.MainMenu)).place(x=765, y=0)

