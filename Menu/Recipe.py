from tkinter import *
from tkinter import DISABLED, NORMAL
from tkinter import messagebox
import MainMenu
import sqlite3
from sqlite3 import Error

previous_value = None
selected_index = None
counter = 1
sql_create_recipe_table = """ CREATE TABLE IF NOT EXISTS recipes (
                                        id integer PRIMARY KEY,
                                        recipe_name text NOT NULL,
                                        ingredients text NOT NULL,
                                        steps text NOT NULL
                                    ); """


def create_table(conn, table):
    try:
        c = conn.cursor()
        c.execute(table)
    except Error:
        print(Error)


def insert(conn, recipe):
    c = conn.cursor()

    try:

        c.execute("INSERT INTO recipes(recipe_name, ingredients, steps) VALUES(?,?,?)", recipe)
        conn.commit()
    except Error:
        print(Error)

    return c.lastrowid


def edit(conn, recipe):
    c = conn.cursor()
    try:
        c.execute("UPDATE recipes SET recipe_name=?, ingredients=?, steps=? WHERE id=?", recipe)
        conn.commit()
    except Error:
        print(Error)


def array_to_string(array):
    string = ""
    for key, value in enumerate(array):
        if value != array[-1]:
            string += f"{value},"
        else:
            string += f"{value}"

    return string


def listbox_select(e):
    global selected_index
    widget = e.widget
    selection = widget.curselection()
    print(selection[0])


class Recipe(Frame):
    def __init__(self, master):

        global previous_value
        Frame.__init__(self, master)
        self.pack(fill=BOTH, expand=YES)
        self.propagate(False)
        self.ingredient = list()
        self.Background_label = None
        self.main_label = None
        self.recipe_label = None
        self.recipe_entry = None
        self.ingredient_label = None
        self.ingredient_entry = None
        self.ingredient_list = None
        self.add = None
        self.add_recipe_button = None
        self.delete = None
        self.deleteAll = None
        self.exit = None
        self.step_list = None
        self.step_label = None
        self.step_label = None
        self.parsed_data = None
        self.entry_text = StringVar()
        self.recipe_db = r"recipe.db"
        self.bg = PhotoImage(file="wall.png")

        self.create_widgets()
        self.parse_data(previous_value)

    def create_widgets(self):
        center_frame = Frame(self, relief='raised', borderwidth=2)
        center_frame.place(relx=0, rely=0, anchor=CENTER)
        self.Background_label = Label(self, image=self.bg)
        self.Background_label.place(x=0, y=0, relwidth=1, relheight=1)
        self.main_label = Label(self, relief='raised', text='Add Ingredients')
        self.recipe_label = Label(self, relief='raised', text='Recipe Name: ')
        self.ingredient_label = Label(self, relief='raised', text='Enter Ingredient: ')
        self.ingredient_list = Listbox(self, height=7, width=20, selectmode='SINGLE')
        self.ingredient_entry = Entry(self, relief='raised', width=20)
        self.recipe_entry = Entry(self, width=20, textvariable=self.entry_text)

        self.add = Button(self, text='Add Ingredient', relief='raised', width=15, command=self.addIngredient)
        self.add_recipe_button = Button(self, text='Add to Recipe' if previous_value is None else 'Edit Recipe',
                                        relief='raised', width=15, command=self.add_recipe)
        self.delete = Button(self, text='Delete', width=15, command=self.delOne)
        self.deleteAll = Button(self, text='Delete all', width=15, command=self.deleteAll)
        self.step_list = Text(self, height=9, width=45)

        # Ingridients
        self.main_label.place(x=20, y=35)  # Add Ingridients
        self.recipe_label.place(x=20, y=60)  # Recipe Name
        self.recipe_entry.place(x=150, y=60)  # Text Box Recipe Name
        self.ingredient_label.place(x=20, y=85)  # Enter Ingridient
        self.ingredient_entry.place(x=150, y=85)  # Text Box Enter Ingridient

        self.ingredient_list.place(x=150, y=110)  # Ingridient Box

        self.add.place(x=20, y=110)  # Add Ingridient
        self.add_recipe_button.place(x=20, y=140)  # Add To Recipe
        self.delete.place(x=20, y=170)  # Delete One Ingridient
        self.deleteAll.place(x=20, y=200)  # Delete All Ingridients

        # Steps
        self.step_label = Label(self, relief='raised', text='Add The Steps').place(x=390, y=240)
        self.step_list.place(x=20, y=240)  # Steps Box
        self.ingredient_list.bind('<<ListboxSelect>>', listbox_select)
        self.Daexit_picture = PhotoImage(file="Close.png")
        self.Daexit = Button(self, image=self.Daexit_picture,
                             command=lambda: self.close()).place(x=765, y=0)

    def close(self):
        global previous_value, counter
        self.recipe_entry.delete(0, END)
        self.step_list.delete('1.0', END)
        self.clearList()
        self.master.switch_frame(MainMenu.MainMenu)
        previous_value = None
        counter = 1

    def parse_data(self, id):
        global counter
        self.parsed_data = id
        conn = None
        if id is not None:
            try:
                conn = sqlite3.connect(self.recipe_db)
                c = conn.cursor()
                c.execute("SELECT * FROM recipes WHERE id=?", (self.parsed_data[0][0],))
                rows = c.fetchall()
                print(f"SQLite says: {rows}")
                self.recipe_entry.insert(0, rows[0][1])
                parsed_list = str(rows[0][2]).split(',')
                for ing in parsed_list:
                    counter += 1
                    self.ingredient.append(ing)
                self.listUpdate()
                self.step_list.insert("1.0", rows[0][3])
            except Error as e:
                print(e)

    def addIngredient(self):
        global counter
        word = self.ingredient_entry.get()
        if len(word) == 0:
            messagebox.showinfo('Empty Entry', 'Enter Ingredient name')
        else:
            self.ingredient.append(f"{counter}.{word}")
            self.listUpdate()
            counter += 1
            self.ingredient_entry.delete(0, 'end')
            self.recipe_entry.config(state=DISABLED)

    def add_recipe(self):
        conn = None
        try:
            conn = sqlite3.connect(self.recipe_db)
            print(sqlite3.version)
            create_table(conn, sql_create_recipe_table)
            print(previous_value)
            if previous_value is None:
                recipe = (self.recipe_entry.get(), array_to_string(self.ingredient), self.step_list.get("1.0", "end"))
                print(insert(conn, recipe))
            else:
                recipe = (self.recipe_entry.get(), array_to_string(self.ingredient),
                          self.step_list.get("1.0", "end"), 1)
                edit(conn, recipe)
        except Error:
            print(Error)
        finally:
            if conn:
                conn.close()

    def listUpdate(self):
        self.clearList()
        for i in self.ingredient:
            self.ingredient_list.insert('end', i)

    def delOne(self):
        global counter
        try:
            counter -= 1
            val = self.ingredient_list.get(self.ingredient_list.curselection())
            if counter == 1:
                self.recipe_entry.config(state=NORMAL)
            if val in self.ingredient:
                self.ingredient.remove(val)
                self.listUpdate()
        except IndexError:
            messagebox.showinfo('Cannot Delete', 'No Ingredient Selected')

    def deleteAll(self):
        global counter
        mb = messagebox.askyesno('Delete All', 'Are you sure?')
        if mb:
            while len(self.ingredient) != 0:
                self.ingredient.pop()
            self.listUpdate()
            counter = 1
            self.recipe_entry.config(state=NORMAL)

    def clearList(self):
        self.ingredient_list.delete(0, 'end')

    def bye(self):
        print(self.ingredient)
        self.master.destroy()
