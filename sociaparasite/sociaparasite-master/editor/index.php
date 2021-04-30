
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Parasite</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script src="../js/nicEdit.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

</head>
<body>
<div class="container" style="margin-bottom: 20px">
    <!--First Article-->
    <span>Social Parasite</span>
    <span style="display: block; font-size: 8px">forever a disappointment to everyone</span>
    <span style="display: block; font-size: 8px">leeching of everyone from their time, bothersome</span>


    <span class="index-name">Add Entry</span>
    <a href="../index.php"><span class="index-name nav-entry" style="font-size: 9px">Home</span></a>

    <form>
        <input type="number" placeholder="Custom ID" id="custom_id" style="margin: 10px"/>
        <input type="text" placeholder="Title" id="title" style="margin: 10px"/>
        <div id="toolbalcontainer"></div>
        <div id="editor-container">
        </div>
        <textarea style="margin-top: 30px" id="niceEdit" rows="20" cols="80"></textarea>


    </form>
    <center><button type="submit" id="submit" onclick="insertEntry()" style="margin: 10px">
            <span class="" id="spansubmit"> Create Post</span>
        </button></center>
</div>
<script>
    function getDateToday(){
        let today = new Date();
        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        return date
    }
    function generateID(){
        let today = new Date();
        let date = today.getDate();
        return date
    }
    function logDB(){
        let title = $("#title").val()
        let custom_id = $("#custom_id").val()
        let filepath = $("#title").val().split(' ').join('_') + ".html".toLocaleLowerCase()
        $.ajax({
            url: 'insertEntry.php',
            method: 'post',
            datatype: 'text',
            data:{
                title: title,
                custom_id: custom_id,
                filepath: filepath,
                key: "logDB",
                entry_date: getDateToday()
            },
            success: function (response,textStatus,xhr) {
                alert("Successfully log to DB")
                location.reload();
            }

        })
    }
    function insertEntry(){
        let getHTMLcontent = document.getElementById('editor-container');
        //let htmlcontent = quill.root.innerHTML;
        let htmlcontent = new nicEditors.findEditor('niceEdit');
        let content = htmlcontent.getContent();
        let temp_title = $("#title").val().split(' ').join('_')
        alert(content)
        if($("#title").val() !== ""){
            $.ajax({
                url: 'insertEntry.php',
                method: 'post',
                datatype: 'text',

                data:{
                    content: content,
                    temp_title: temp_title,
                    key: 'writeHTML'
                },
                success: function (response,textStatus,xhr) {
                    logDB()
                }

            })
        }else {
            alert("Empty title")
        }
    }


    $(document).ready(function () {
        $("#custom_id").val(generateID());
    })
</script>
</body>
</html>
