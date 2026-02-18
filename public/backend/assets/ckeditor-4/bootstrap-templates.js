// public/js/bootstrap-templates.js
CKEDITOR.addTemplates("bootstrap_templates", {
    imagesPath: "/images/templates/",
    templates: [
        {
            title: "Two Columns (6-6)",
            description: "Bootstrap grid with 2 equal columns",
            html:
                '<div class="row">' +
                '<div class="col-md-6"><p>Content for left column</p></div>' +
                '<div class="col-md-6"><p>Content for right column</p></div>' +
                "</div>",
        },
        {
            title: "Three Columns (4-4-4)",
            description: "Three equal columns",
            html:
                '<div class="row">' +
                '<div class="col-md-4"><p>Column 1 content</p></div>' +
                '<div class="col-md-4"><p>Column 2 content</p></div>' +
                '<div class="col-md-4"><p>Column 3 content</p></div>' +
                "</div>",
        },
        {
            title: "Image + Text (6-6)",
            description: "6 columns image + 6 columns text",
            html:
                '<div class="row align-items-center">' +
                '<div class="col-md-6"><img src="/placeholder.jpg" class="img-fluid" alt="Image"></div>' +
                '<div class="col-md-6"><h3>Title Here</h3><p>Your content goes here...</p></div>' +
                "</div>",
        },
        {
            title: "Text + Image (6-6)",
            description: "6 columns text + 6 columns image",
            html:
                '<div class="row align-items-center">' +
                '<div class="col-md-6"><h3>Title Here</h3><p>Your content goes here...</p></div>' +
                '<div class="col-md-6"><img src="/placeholder.jpg" class="img-fluid" alt="Image"></div>' +
                "</div>",
        },
        {
            title: "Two Columns (4-8)",
            description: "4 columns image + 8 columns content",
            html:
                '<div class="row align-items-center">' +
                '<div class="col-md-4"><img src="/placeholder.jpg" class="img-fluid" alt="Image"></div>' +
                '<div class="col-md-8"><h3>Title Here</h3><p>Your content goes here...</p></div>' +
                "</div>",
        },
        {
            title: "Three Columns with Images",
            description: "Three columns each with image and text",
            html:
                '<div class="row">' +
                '<div class="col-md-4"><img src="/placeholder.jpg" class="img-fluid mb-3"><h4>Title 1</h4><p>Content 1</p></div>' +
                '<div class="col-md-4"><img src="/placeholder.jpg" class="img-fluid mb-3"><h4>Title 2</h4><p>Content 2</p></div>' +
                '<div class="col-md-4"><img src="/placeholder.jpg" class="img-fluid mb-3"><h4>Title 3</h4><p>Content 3</p></div>' +
                "</div>",
        },
        {
            title: "Two Rows Grid",
            description: "Complex grid with multiple rows",
            html:
                '<div class="container">' +
                '<div class="row mb-4">' +
                '<div class="col-12"><h2>Main Title</h2></div>' +
                "</div>" +
                '<div class="row">' +
                '<div class="col-md-6"><img src="/placeholder.jpg" class="img-fluid"></div>' +
                '<div class="col-md-6"><h3>Section Title</h3><p>Description text...</p></div>' +
                "</div>" +
                '<div class="row mt-4">' +
                '<div class="col-md-4">Feature 1</div>' +
                '<div class="col-md-4">Feature 2</div>' +
                '<div class="col-md-4">Feature 3</div>' +
                "</div>" +
                "</div>",
        },
    ],
});
