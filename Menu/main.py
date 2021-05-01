import tkinter as tk

from PIL import ImageTk, Image
from MainMenu import MainMenu
from Startup import Startup
from Maker import About
from Recipe import Recipe
from Read import Read


class Controller(tk.Tk):
    def __init__(self, title, size):
        tk.Tk.__init__(self)
        self.frame_title = title
        self.size = size
        self.frame = None

    def run(self):
        self.switch_frame(Startup)
        self.title(self.frame_title)
        self.geometry(self.size)
        self.iconphoto(False, ImageTk.PhotoImage(Image.open('pin.ico', 'r')))
        self.resizable(False, False)
        self.mainloop()

    def switch_frame(self, frame):
        new_frame = frame(self)
        if self.frame is not None:
            self.frame.destroy()
        self.frame = new_frame
        self.frame.pack()


if __name__ == "__main__":
    app = Controller("Cookbook", "800x400")
    app.run()
