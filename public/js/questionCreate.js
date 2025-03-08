document.addEventListener("DOMContentLoaded", function () {
    let quills = [];
    for (let i = 0; i < 5; i++) {
        let editorElem = document.querySelector(`#editor${i}`);
        if (!editorElem) continue;
        quills[i] = new Quill(editorElem, {
            theme: 'snow'
        });
        quills[i].on('text-change', function () {
            if (i === 0) {
                document.querySelector("input[name='question_text']").value = quills[i].root.innerHTML;
            } else {
                 document.querySelector(`input[name='answers[${i}]']`).value = quills[i].root.innerHTML;
            }
        });
    }
    document.querySelector("form").addEventListener("submit", function () {
        if (quills[0]) {
            document.querySelector("input[name='question_text']").value = quills[0].root.innerHTML;
        }
        for (let i = 1; i < 5; i++) {
           document.querySelector(`input[name='answers[${i}]']`).value = quills[i].root.innerHTML;
        }
    });
});
