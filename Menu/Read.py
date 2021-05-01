from tkinter import *
from PIL import ImageTk, Image
from tkinter import messagebox
import sqlite3
from sqlite3 import Error
import re
import MainMenu
import Recipe


def create_connection(db_file):
    conn = None
    try:
        conn = sqlite3.connect(db_file)
    except Error:
        print(Error)

    return conn


class Read(Frame):
    def __init__(self, master):
        Frame.__init__(self, master)
        self.pack(fill=BOTH, expand=YES)
        self.propagate(False)
        self.Background_label = None
        self.output_list = None
        self.bg = PhotoImage(file="ripple.png")
        self.icon = ImageTk.PhotoImage(Image.open("pin.ico"))
        self.recipes = []
        self.current_recipe = []
        self.db_file = r'recipe.db'
        self.conn = create_connection(self.db_file)
        self.create_widgets()
        self.get_data(self.conn)

    def get_data(self, conn):
        with conn:
            try:
                c = conn.cursor()
                c.execute("SELECT recipe_name FROM recipes")
                rows = c.fetchall()
                regex = re.compile('[^a-zA-Z]')
                for row in rows:
                    self.recipes.append(regex.sub('', str(row)))
                self.update_list()
            except Error as e:
                messagebox.showinfo("Yikes", e)


    def update_list(self):
        self.clear_list()
        if len(self.recipes) != 0:
            for i in self.recipes:
                self.output_list.insert('end', i)

    def listbox_select(self, e):
        widget = e.widget
        selection = widget.curselection()
        picked = widget.get(selection[0])
        conn = create_connection(r'recipe.db')
        try:
            c = conn.cursor()
            c.execute("SELECT * FROM recipes WHERE recipe_name=?", (picked,))
            rows = c.fetchall()
            Recipe.previous_value = rows
            self.master.switch_frame(Recipe.Recipe)
        except Error as e:
            print(e)

    def clear_list(self):
        if len(self.recipes) != 0:
            self.output_list.delete(0, 'end')

    def create_widgets(self):
        self.Background_label = Label(self, image=self.bg)
        self.Background_label.place(x=0, y=0, relwidth=1, relheight=1)
        center_frame = Frame(self, relief='raised', borderwidth=2)
        center_frame.place(relx=0.5, rely=0.5, anchor=CENTER)
        self.output_list = Listbox(self, height=20, width=110, selectmode='SINGLE')  # TextBox
        self.output_list.place(x=70, y=50)
        self.Dabutton_picture = PhotoImage(file="Close.png")
        self.Dabutton = Button(self, image=self.Dabutton_picture,
                               command=lambda: self.master.switch_frame(MainMenu.MainMenu)).place(x=765, y=0)
        self.output_list.bind('<<ListboxSelect>>', self.listbox_select)
