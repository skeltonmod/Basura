from bs4 import BeautifulSoup
import requests
import json
from requests import Session


def getUSN(usn):
    credential = {}
    with open('usn.json') as json_file:
        data = json.load(json_file)
        for x in data['accounts']:
            if x['usn'] == usn:
                credential = {"Username": x['usn'], "Password": x['usnpass']}
        return credential


def checkAccount(usn):
    doesexist = False
    with open('usn.json') as json_file:
        data = json.load(json_file)
        for x in data['accounts']:
            if x['usn'] == usn:
                doesexist = True
    return doesexist


def getTuitionFeeTotal(credential):
    with Session() as s:
        payload = credential
        login_form = s.post("https://discipulus.amasystem.net/Auth/UserLogin", data=payload)
        print(login_form.text)
        print(payload['Username'])
        payload = {"StudentID": payload['Username'], "SyTerm": "2013"}
        new_page = s.post("https://discipulus.amasystem.net/Dashboard/AssesmentFormSumarryCopyv2/", data=payload)
        json_file = json.loads(new_page.json()['data'])
        return json_file[0]['TotalFees']


def getSubjects(credential):
    with Session() as s:
        returnString = ""
        payload = credential
        login_form = s.post("https://discipulus.amasystem.net/Auth/UserLogin", data=payload)
        payload = {"StudentID": payload['Username'], "SyTerm": "2013"}
        new_page = s.post("https://discipulus.amasystem.net/Dashboard/AssesmentFormDestailsCopyv2/", data=payload)
        json_file = json.loads(new_page.json()['data'])
        for x in range(len(json_file)):
            returnString += f'\n{json_file[x]["SUBJECT"]}: {json_file[x]["DESCRIPTION"]}->{json_file[x]["UNITS"]}'
        return returnString


def getRemainingBalance(credential):
    with Session() as s:
        payload = credential
        login_form = s.post("https://discipulus.amasystem.net/Auth/UserLogin", data=payload)
        payload = {"StudentID": payload['Username'], "SyTerm": "2013"}
        new_page = s.post("https://discipulus.amasystem.net/Dashboard/AssesmentFormSumarryCopyv2/", data=payload)
        json_file = json.loads(new_page.json()['data'])
        return json_file[0]['NetCharge']


def getGrade(credential):
    with Session() as s:
        returnString = ""
        payload = credential
        login_form = s.post("https://discipulus.amasystem.net/Auth/UserLogin", data=payload)
        checklistCookie = s.get("https://discipulus.amasystem.net/CurriculumChecklist/GetChecklist")
        new_page = s.post("https://discipulus.amasystem.net/CurriculumChecklist/GetChecklist",
                          {"cookie": checklistCookie})
        json_file = json.loads(new_page.json()['data'])

        for x in range(len(json_file['Table'])):
            if json_file['Table'][x]['AlphabeticalGrade'] != "":
                returnString += (f"\n{json_file['Table'][x]['CourseCode']}: {json_file['Table'][x]['CourseTitle']} -> "
                                 f"{json_file['Table'][x]['AlphabeticalGrade']} ({json_file['Table'][x]['Remarks']})\n")
        return returnString
