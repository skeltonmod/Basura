import json
import re
import sys
import fbchat
import credentials
from fbchat import Client
from fbchat import log

fbchat._util.USER_AGENTS = [
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36"]
fbchat._state.FB_DTSG_REGEX = re.compile(r'"name":"fb_dtsg","value":"(.*?)"')


# Subclass fbchat.Client and override required methods
def writeJSON(data, filename="archive.json"):
    with open(filename, "w") as file:
        json.dump(data, file, indent=4)


class AMABOT(Client):
    messages = []

    def onMessage(self, author_id, message_object, thread_id, thread_type, **kwargs):
        # check if james

        if (author_id == "100031300578634"):
            message_object.text = "Saba James!"
            self.send(message_object, thread_id=thread_id, thread_type=thread_type)
        # prevent chui from deleting

        self.markAsDelivered(thread_id, message_object.uid)
        self.markAsRead(thread_id)
        log.info("{} from {} in {}".format(message_object, thread_id, thread_type.name))

        # GET SENDER INFORMATION
        users = self.fetchUserInfo(message_object.author)
        if author_id != self.uid:
            x = {
                "user_id": message_object.author,
                "username": users[message_object.author].first_name,
                "message": message_object.text
            }
            # push to JSON
            if not message_object.text.startswith("/"):
                with open("archive.json") as json_file:
                    data = json.load(json_file)
                    temp = data['message_details']
                    temp.append(x)
                    writeJSON(data)
            if author_id == "100001307014900" or author_id == "100027193340253":
                if message_object.text.startswith("/getmessage"):
                    # get the USER ID first
                    digest = message_object.text.split(' ')
                    # fetch the JSON messages
                    if len(digest) == 2:
                        with open("archive.json") as json_file:
                            data = json.load(json_file)
                            for x in data['message_details']:
                                if x['username'] == digest[1]:
                                    print(x['message'])
                                    message_object.text += f'\n ({x["username"]})-> {x["message"]}\n'
                    self.send(message_object, thread_id=thread_id, thread_type=thread_type)

            if message_object.text.startswith("/register"):

                digest = message_object.text.split(' ')
                if len(digest) == 3:
                    x = {
                        "usn": digest[1],
                        "usnpass":digest[2]
                    }
                    with open('usn.json') as json_file:
                        data = json.load(json_file)
                        temp = data['accounts']
                        temp.append(x)
                        writeJSON(data, "usn.json")

            if message_object.text.startswith('/getgrades'):
                digest = message_object.text.split(' ')
                if len(digest) == 2:
                    print(credentials.getGrade(credentials.getUSN(digest[1])))
                    message_object.text = credentials.getGrade(credentials.getUSN(digest[1]))
                    self.send(message_object, thread_id=thread_id, thread_type=thread_type)

            if message_object.text.startswith('/gettuitiontotal'):
                digest = message_object.text.split(' ')
                if len(digest) == 2:
                    print(credentials.getTuitionFeeTotal(credentials.getUSN(digest[1])))
                    message_object.text = credentials.getTuitionFeeTotal(credentials.getUSN(digest[1]))
                    self.send(message_object, thread_id=thread_id, thread_type=thread_type)

            if message_object.text.startswith('/getpayables'):
                digest = message_object.text.split(' ')
                if len(digest) == 2:
                    print(credentials.getRemainingBalance(credentials.getUSN(digest[1])))
                    message_object.text = credentials.getRemainingBalance(credentials.getUSN(digest[1]))
                    self.send(message_object, thread_id=thread_id, thread_type=thread_type)

            if message_object.text.startswith('/getsubjects'):
                digest = message_object.text.split(' ')
                if len(digest) == 2:
                    print(credentials.getSubjects(credentials.getUSN(digest[1])))
                    message_object.text = credentials.getSubjects(credentials.getUSN(digest[1]))
                    self.send(message_object, thread_id=thread_id, thread_type=thread_type)

            if message_object.text.startswith("/help"):
                message_object.text = f'\n Here are the list of available commands\n'
                message_object.text += f'\n /version: Returns the current Python version \n \n'
                message_object.text += f'\n /register <usn> <usnpass>: Add your account to disciplus API \n \n'
                message_object.text += f'\n /gettuitiontotal <usn>: Get total tuition from disciplus API \n \n'
                message_object.text += f'\n /getsubjects <usn>: Get Subjects from disciplus API \n \n'
                message_object.text += f'\n /getpayables <usn>: Get Payables from disciplus API \n \n'
                message_object.text += f'\n /getgrade <usn>: Get Grade from disciplus API \n \n'

                message_object.text += f'\n WORK IN PROGRESS! \n'
                self.send(message_object, thread_id=thread_id, thread_type=thread_type)
                pass
            if message_object.text.startswith("/version"):
                message_object.text = sys.version
                self.send(message_object, thread_id=thread_id, thread_type=thread_type)

    # write to JSON file


client = AMABOT("negroboi70@gmail.com", "biggesttabina1234")
client.listen()
