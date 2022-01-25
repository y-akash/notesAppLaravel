<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/css/notes.css">
    <title>Notes</title>
</head>

<body>
    <div class="take-note">
        <div class="user">
            <p>Hello, <span>{{$name}}</span></p>
            <div>
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="/logout" method="POST">
                    @csrf
                </form>
            </div>
        </div>
        <form id="addNote" action="/note" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title">
            <textarea name="noteDesc" rows="5" placeholder="Take a note..."></textarea>
            <button type="submit">Add</button>
        </form>
    </div>
    <hr><br>
    <div class="notes">
<!--        end of for loop-->
        @foreach ($notes as $note)
            <div class="note" data-aos="fade-up">
                <h2>{{$note->title}}</h2>
                <hr>
                <p>{{$note->noteDesc}}</p>
                <input type="hidden" name="id" value="{{$note->noteId}}">
                <div class="note-edit">
                    <button onclick="buttonShowModal(this)">Show</button>
                    <button onclick="buttonEditModal(this)" class="edit-button"><img src="/img/edit.png" alt="edit"></button>
                    <form action="/note" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value = "{{$note->noteId}}">
                        <button><img src="/img/delete.png" alt="delete"></button>
                    </form>
                </div>
            </div>
        @endforeach
<!--        end of for loop-->
    </div>
    <div class="edit-modal" id="editModal">
    </div>
    <div class="show-modal" id="showModal">
    </div>
<script src="/js/notes.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 120,
        duration: 900
    });
</script>
</body>

</html>
