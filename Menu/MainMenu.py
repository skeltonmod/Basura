from tkinter import *
from PIL import ImageTk, Image

from Maker import About
from Recipe import Recipe
from Read import Read


class MainMenu(Frame):
    def __init__(self, master):
        Frame.__init__(self, master)
        self.pack(fill=BOTH, expand=YES)
        self.propagate(False)
        self.Background_label = None
        self.Create_hover_label = None
        self.Create_button = None
        self.Recipe_button = None
        self.Maker_button = None
        self.Hover_Label = None
        self.Exit_button = None
        self.Exit_picture = PhotoImage(file="exit.png")
        self.Maker_picture = PhotoImage(file="statue.png")
        self.Create_picture = PhotoImage(file="add.png")
        self.bg = PhotoImage(file="wallpaper (1).png")
        self.Recipe_picture = PhotoImage(file="book.png")
        self.icon = ImageTk.PhotoImage(Image.open("pin.ico"))

        self.create_widgets()

    def create_widgets(self):
        self.Background_label = Label(self, image=self.bg)
        self.Background_label.place(x=0, y=0, relwidth=1, relheight=1)
        center_frame = Frame(self, relief='raised', borderwidth=2)
        center_frame.place(relx=0.5, rely=0.5, anchor=CENTER)
        self.Create_hover_label = Label(center_frame, text='Test')
        self.Create_button = Button(center_frame, image=self.Create_picture,
                                    command=lambda: self.master.switch_frame(Recipe))
        self.Maker_button = Button(center_frame, image=self.Maker_picture,
                                   command=lambda: self.master.switch_frame(About))
        self.Hover_Label = Label(self, text='', bd=1, relief=SUNKEN, anchor=E)
        self.Recipe_button = Button(center_frame, image=self.Recipe_picture, command=lambda: self.master.switch_frame(Read))
        self.Exit_button = Button(center_frame, image=self.Exit_picture, command=quit)
        self.Create_button.grid(row=5, column=0, ipadx=10)
        self.Recipe_button.grid(row=5, column=1, ipadx=10)
        self.Maker_button.grid(row=5, column=2, ipadx=10)
        self.Exit_button.grid(row=5, column=3, ipadx=10)
        self.Hover_Label.pack(fill=X, side=BOTTOM, ipady=1)
        self.bind_buttons()

    def bind_buttons(self):
        self.Create_button.bind("<Enter>", self.on_hover)
        self.Create_button.bind("<Leave>", self.on_hover)
        self.Create_button.bind("<Button>", self.on_hover)
        self.Recipe_button.bind("<Enter>", self.on_hover)
        self.Recipe_button.bind("<Leave>", self.on_hover)
        self.Maker_button.bind("<Enter>", self.on_hover)
        self.Maker_button.bind("<Leave>", self.on_hover)
        self.Maker_button.bind("<Button>", self.on_hover)
        self.Exit_button.bind("<Enter>", self.on_hover)
        self.Exit_button.bind("<Leave>", self.on_hover)

    def on_hover(self, e):
        self.Create_button["bg"] = "white"
        if str(e.widget) == ".!mainmenu.!frame.!button":
            self.Hover_Label.config(text="Create Recipe")
        if str(e.widget) == ".!mainmenu.!frame.!button3":
            self.Hover_Label.config(text="Recipes")
        if str(e.widget) == ".!mainmenu.!frame.!button2":
            self.Hover_Label.config(text="About us")
        if str(e.widget) == ".!mainmenu.!frame.!button4":
            self.Hover_Label.config(text="Exit")
