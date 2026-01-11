import './bootstrap';
import EasyMDE from "easymde";
import "easymde/dist/easymde.min.css";

document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.getElementById('markdown-editor');

    if (textarea) {
        new EasyMDE({
            element: textarea,
            spellChecker: false,

            placeholder: "Пиши статью в Markdown...",

            status: ["lines", "words"],

            autosave: {
                enabled: true,
                uniqueId: textarea.dataset.autosaveId || "vectorup-new-article",
                delay: 1000,
            },

            uploadImage: true,
            imageUploadEndpoint: "/admin/upload",
            imageUploadFieldName: "image",
            imagePathAbsolute: true,

            csrfToken: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        });

    }
});

