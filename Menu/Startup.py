from tkinter import *
from PIL import ImageTk, Image


#Its like Startup but when the button was pressed goes to main menu
import MainMenu


class Startup(Frame):
    def __init__(self, master):
        Frame.__init__(self, master)
        self.pack(fill=BOTH, expand=YES)
        self.propagate(False)
        self.Background_label = None
        self.Startup_button = None
        self.Startup_picture = PhotoImage(file="windowsstart.png")
        self.bg = PhotoImage(file="start.png")
        self.icon = ImageTk.PhotoImage(Image.open("pin.ico"))
        self.create_widgets()

    def create_widgets(self):
        self.Background_label = Label(self, image=self.bg)
        self.Background_label.place(x=0, y=0, relwidth=1, relheight=1)
        center_frame = Frame(self, relief='raised', borderwidth=2)
        center_frame.place(relx=0.5, rely=0.5, anchor=CENTER)
        self.Startup_button = Button(center_frame, image=self.Startup_picture,
                                    command=lambda: self.master.switch_frame(MainMenu.MainMenu))
        self.Startup_button.grid(row=5, column=0, ipadx=0)