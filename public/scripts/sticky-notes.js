document.addEventListener("DOMContentLoaded", () => {
    const addNoteBtn = document.getElementById("add-note");
    const notesContainer = document.getElementById("notes-container");
    const roomId = window.location.pathname.split("/")[2];

    function createNoteElement(note) {
        const noteEl = document.createElement("textarea");
        noteEl.classList.add("sticky-note");
        noteEl.value = note.content || "";
        noteEl.placeholder = "Write a note...";
        noteEl.addEventListener("change", () => {
            fetch(`/update-note`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: note.id, content: noteEl.value })
            });
        });
        notesContainer.appendChild(noteEl);
    }

    function loadNotes() {
        fetch(`/get_note?roomId=${roomId}`)
            .then(res => res.json())
            .then(data => {
                notesContainer.innerHTML = "";
                data.notes.forEach(createNoteElement);
            });
    }

    addNoteBtn.addEventListener("click", () => {
        fetch(`/add-note`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ roomId })
        })
        .then(res => res.json())
        .then(note => createNoteElement(note));
    });

    loadNotes();
});
