from tkinter import *

root = Tk()
root.title('Background Testing Site')
root.geometry("800x500")
#root.resizable(False, False)

bg = PhotoImage(file ="gridpink.png")

my_canvas = Canvas(root, width=800, height=500)
my_canvas.pack(fill="both", expand=False)

my_canvas.create_image(0,0, image=bg, anchor="nw")
my_canvas.create_text(400, 250, text="Welcome", font=("Bahnschrift SemiBold Condensed", 50, "italic", "underline"),fill="white")

button1 = Button(root, text="start")
button1_window = my_canvas.create_window(10,10, anchor="s", window=button1)
#my_label = Label(root, image=bg)
#my_label.place(x=0, y=0, relwidth=1, relheight=1)

my_text = Label(root, text="My Cookbook", font=("Bahnschrift SemiBold Condensed", 50, "italic", "underline"), fg="black", bg="#c0c0c0")
my_text.pack(pady=0, ipady=10, ipadx=30)

#my_frame = Frame(root, bg='#c0c0c0')
#my_frame.pack(pady=0, ipadx=0, ipady=5)

#my_button1 = Button(my_frame, text="Create")
#my_button1.grid(row=0, column=0, padx=1, ipadx=27)







root.mainloop()