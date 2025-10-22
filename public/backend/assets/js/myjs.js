const text = "Tawana";
const typingElement = document.getElementById("typing");

let index = 0;
let isDeleting = false;

function typeEffect() {
  if (!isDeleting && index <= text.length) {
    typingElement.textContent = text.substring(0, index);
    index++;
  } else if (isDeleting && index >= 0) {
    typingElement.textContent = text.substring(0, index);
    index--;
  }

  if (index > text.length) {
    isDeleting = true;
    setTimeout(typeEffect, 800);
    return;
  }

  if (index < 0) {
    isDeleting = false;
  }

  setTimeout(typeEffect, isDeleting ? 100 : 150);
}

typeEffect();



// pages swicthing --------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
  // ===== صفحه دسته‌بندی‌ها =====
  const addNewBtn = document.getElementById("addNewBtn");
  const backBtn = document.getElementById("backBtn");
  const categoriesPage = document.getElementById("categories-page");
  const addCategoryPage = document.getElementById("add-category-page");
  const categoryForm = document.getElementById("categoryForm");

  if (addNewBtn && categoriesPage && addCategoryPage) {
    addNewBtn.addEventListener("click", function (e) {
      e.preventDefault();
      categoriesPage.style.display = "none";
      addCategoryPage.style.display = "block";
    });
  }

  if (backBtn && categoriesPage && addCategoryPage) {
    backBtn.addEventListener("click", function (e) {
      e.preventDefault();
      addCategoryPage.style.display = "none";
      categoriesPage.style.display = "block";
    });
  }

  if (categoryForm && categoriesPage && addCategoryPage) {
    categoryForm.addEventListener("submit", function (e) {
      e.preventDefault();
      alert(
        "Category saved!\n\nName: " +
          this.categoryName.value +
          "\nDescription: " +
          this.categoryDesc.value
      );
      this.reset();
      addCategoryPage.style.display = "none";
      categoriesPage.style.display = "block";
    });
  }


  const addNewSubBtn = document.getElementById("addNewSubBtn");
  const backSubBtn = document.getElementById("backSubBtn");
  const subcategoriesPage = document.getElementById("subcategories-page");
  const addSubcategoryPage = document.getElementById("add-subcategory-page");

  if (addNewSubBtn && subcategoriesPage && addSubcategoryPage) {
    addNewSubBtn.addEventListener("click", function (e) {
      e.preventDefault();
      subcategoriesPage.style.display = "none";
      addSubcategoryPage.style.display = "block";
    });
  }

  if (backSubBtn && subcategoriesPage && addSubcategoryPage) {
    backSubBtn.addEventListener("click", function (e) {
      e.preventDefault();
      subcategoriesPage.style.display = "block";
      addSubcategoryPage.style.display = "none";
    });
  }


//  add question page code -----------------------------------------------
  let data = [
    {
      category: "Web Design",
      subcategories: [
        { name: "JavaScript", questions: [] },
        { name: "CSS", questions: [] },
      ],
    },
    {
      category: "Cyber Security",
      subcategories: [
        { name: "Network Security", questions: [] },
        { name: "Ethical Hacking", questions: [] },
      ],
    },
    {
      category: "ICDL",
      subcategories: [{ name: "Word Processing", questions: [] }],
    },
  ];

  const storedData = localStorage.getItem("quizData");
  if (storedData) data = JSON.parse(storedData);

  const container = document.getElementById("accordionContainer");
  const addQuestionBtn = document.getElementById("addQuestionBtn");
  const questionsPage = document.querySelector(
    ".main-container.container-form"
  );
  const addQuestionPage = document.querySelectorAll(".main-container")[1];
  const categorySelect = document.getElementById("categorySelect");
  const subcategorySelect = document.getElementById("subcategorySelect");
  const answersContainer = document.getElementById("answersContainer");
  const multiCorrectCheckbox = document.getElementById("multiCorrectCheckbox");
  const addAnswerBtn = document.getElementById("addAnswerBtn");
  const form = document.getElementById("questionForm");

  let editingQuestion = null;

  addQuestionPage.style.display = "none";

  let openCategories = new Set();
  let openSubcategories = new Set();

  function renderQuestions() {
    container.innerHTML = "";

    data.forEach((cat) => {
      const categoryDiv = document.createElement("div");
      categoryDiv.classList.add("category");

      const header = document.createElement("div");
      header.classList.add("category-header");
      header.innerHTML = `${cat.category} <span class="arrow">&#9654;</span>`;
      categoryDiv.appendChild(header);

      const subList = document.createElement("div");
      subList.classList.add("subcategory-list");
      if (openCategories.has(cat.category)) {
        subList.classList.add("open");
        header.classList.add("active");
        header.querySelector(".arrow").style.transform = "rotate(90deg)";
      }

      cat.subcategories.forEach((subcat) => {
        const subItem = document.createElement("div");
        subItem.classList.add("subcategory-item");

        const subHeader = document.createElement("div");
        subHeader.classList.add("subcategory-header");
        subHeader.innerHTML = `${subcat.name} <span class="arrow">&#9654;</span>`;
        subHeader.style.cursor = "pointer";
        subItem.appendChild(subHeader);

        const questionList = document.createElement("ul");
        questionList.style.listStyleType = "none";
        questionList.style.display = openSubcategories.has(subcat.name)
          ? "block"
          : "none";
        if (openSubcategories.has(subcat.name)) {
          subHeader.classList.add("active");
          subHeader.querySelector(".arrow").style.transform = "rotate(90deg)";
        }

        subcat.questions.forEach((q, index) => {
          const li = document.createElement("li");
          li.style.display = "flex";
          li.style.justifyContent = "space-between";
          li.style.alignItems = "center";
          li.style.fontSize = "18px";
          li.style.marginBottom = "5px";

          // متن سوال
          const questionText = document.createElement("span");
          questionText.textContent = `${index + 1}. ${q.question}`;

          li.appendChild(questionText);

          // دکمه‌ها
          const actionsDiv = document.createElement("div");

          actionsDiv.style.marginTop = "10px";
          const editBtn = document.createElement("button");
          editBtn.innerHTML = '<i class="fas fa-edit"></i>'; // آیکون Edit
          editBtn.style.backgroundColor = "green";
          editBtn.style.color = "#fff";
          editBtn.style.border = "none";
          editBtn.style.padding = "4px 8px";
          editBtn.style.borderRadius = "4px";
          editBtn.style.marginLeft = "5px";
          editBtn.style.cursor = "pointer";
          editBtn.addEventListener("click", () => editQuestion(cat, subcat, q));

          const deleteBtn = document.createElement("button");
          deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>'; // آیکون Delete
          deleteBtn.style.backgroundColor = "red";
          deleteBtn.style.color = "#fff";
          deleteBtn.style.border = "none";
          deleteBtn.style.padding = "4px 8px";
          deleteBtn.style.borderRadius = "4px";
          deleteBtn.style.marginLeft = "5px";
          deleteBtn.style.cursor = "pointer";
          deleteBtn.addEventListener("click", () =>
            confirmDeleteQuestion(cat, subcat, q)
          );

          actionsDiv.appendChild(editBtn);
          actionsDiv.appendChild(deleteBtn);

          li.appendChild(actionsDiv);
          questionList.appendChild(li);
        });

        subHeader.addEventListener("click", () => {
          const isOpen = questionList.style.display === "block";

          document
            .querySelectorAll(".subcategory-item ul")
            .forEach((ul) => (ul.style.display = "none"));
          document
            .querySelectorAll(".subcategory-header.active")
            .forEach((sh) => {
              sh.classList.remove("active");
              sh.querySelector(".arrow").style.transform = "rotate(0deg)";
            });

          questionList.style.display = isOpen ? "none" : "block";
          if (!isOpen) {
            subHeader.classList.add("active");
            subHeader.querySelector(".arrow").style.transform = "rotate(90deg)";
            openSubcategories.add(subcat.name);
          } else {
            openSubcategories.delete(subcat.name);
          }
        });

        subItem.appendChild(questionList);
        subList.appendChild(subItem);
      });

      header.addEventListener("click", () => {
        const isOpen = subList.classList.contains("open");

        document
          .querySelectorAll(".subcategory-list.open")
          .forEach((l) => l.classList.remove("open"));
        document.querySelectorAll(".category-header.active").forEach((h) => {
          h.classList.remove("active");
          h.querySelector(".arrow").style.transform = "rotate(0deg)";
        });

        if (!isOpen) {
          subList.classList.add("open");
          header.classList.add("active");
          header.querySelector(".arrow").style.transform = "rotate(90deg)";
          openCategories.add(cat.category);
        } else {
          openCategories.delete(cat.category);
        }
      });

      categoryDiv.appendChild(subList);
      container.appendChild(categoryDiv);
    });
  }

  function fillCategories() {
    categorySelect.innerHTML =
      '<option value="" disabled selected>Select Category</option>';
    data.forEach((cat) => {
      const option = document.createElement("option");
      option.value = cat.category;
      option.textContent = cat.category;
      categorySelect.appendChild(option);
    });
    subcategorySelect.innerHTML =
      '<option value="" disabled selected>First choose the menu</option>';
    subcategorySelect.disabled = true;
  }

  function addAnswer(answerText = "", selected = false) {
    const currentCount =
      answersContainer.querySelectorAll(".answer-item").length;
    if (currentCount >= 4) return;

    const answerDiv = document.createElement("div");
    answerDiv.classList.add("answer-item");

    const answerInput = document.createElement("input");
    answerInput.type = "text";
    answerInput.placeholder = `Answer ${currentCount + 1}`;
    answerInput.required = true;
    answerInput.value = answerText;

    const actionsDiv = document.createElement("div");
    actionsDiv.classList.add("answer-actions");

    const checkBtn = document.createElement("button");
    checkBtn.type = "button";
    checkBtn.classList.add("check-btn");
    checkBtn.innerHTML = '<i class="fas fa-check-double"></i>';
    if (selected) {
      checkBtn.classList.add("checked");
      answerDiv.classList.add("selected");
    }

    checkBtn.addEventListener("click", () => {
      if (!multiCorrectCheckbox.checked) {
        document.querySelectorAll(".check-btn.checked").forEach((btn) => {
          btn.classList.remove("checked");
          btn.parentElement.parentElement.classList.remove("selected");
        });
      }
      checkBtn.classList.toggle("checked");
      answerDiv.classList.toggle("selected");
    });

    const deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.classList.add("delete-btn");
    deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';
    deleteBtn.addEventListener("click", () => {
      answerDiv.remove();
      updateAnswerPlaceholders();
    });

    actionsDiv.appendChild(checkBtn);
    actionsDiv.appendChild(deleteBtn);
    answerDiv.appendChild(answerInput);
    answerDiv.appendChild(actionsDiv);
    answersContainer.appendChild(answerDiv);
  }

  function updateAnswerPlaceholders() {
    answersContainer
      .querySelectorAll('input[type="text"]')
      .forEach((input, idx) => {
        input.placeholder = `Answer ${idx + 1}`;
      });
  }

  function editQuestion(cat, subcat, question) {
    editingQuestion = question;

    addQuestionPage.style.display = "block";
    questionsPage.style.display = "none";

    categorySelect.value = cat.category;
    subcategorySelect.disabled = false;
    subcategorySelect.innerHTML = `<option value="${subcat.name}" selected>${subcat.name}</option>`;

    document.getElementById("questionTextarea").value = question.question;
    multiCorrectCheckbox.checked = question.multi;
    answersContainer.innerHTML = "";
    question.answers.forEach((ans, idx) => {
      const selected = question.multi
        ? question.correctIndexes.includes(idx)
        : question.correctIndex === idx;
      addAnswer(ans, selected);
    });
  }

  function confirmDeleteQuestion(cat, subcat, question) {
    const overlay = document.createElement("div");
    overlay.style.position = "fixed";
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = "100%";
    overlay.style.height = "100%";
    overlay.style.backgroundColor = "rgba(0,0,0,0.5)";
    overlay.style.display = "flex";
    overlay.style.alignItems = "center";
    overlay.style.justifyContent = "center";
    overlay.style.zIndex = 1000;

    const modal = document.createElement("div");
    modal.style.backgroundColor = "#fff";
    modal.style.padding = "20px";
    modal.style.borderRadius = "8px";
    modal.innerHTML = `
      <p>Are you sure you want to delete this question?</p>
      <button id="confirmDelete">Yes</button>
      <button id="cancelDelete">No</button>
    `;
    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    overlay
      .querySelector("#cancelDelete")
      .addEventListener("click", () => overlay.remove());
    overlay.querySelector("#confirmDelete").addEventListener("click", () => {
      subcat.questions = subcat.questions.filter((q) => q !== question);
      overlay.remove();
      renderQuestions();
    });
  }

  // ====== Event Listeners ======
  fillCategories();
  renderQuestions();
  addAnswer();

  categorySelect.addEventListener("change", () => {
    subcategorySelect.innerHTML =
      '<option value="" disabled selected>Select Subcategory</option>';
    const selectedCat = data.find(
      (cat) => cat.category === categorySelect.value
    );
    if (selectedCat) {
      selectedCat.subcategories.forEach((sub) => {
        const option = document.createElement("option");
        option.value = sub.name;
        option.textContent = sub.name;
        subcategorySelect.appendChild(option);
      });
      subcategorySelect.disabled = false;
    } else subcategorySelect.disabled = true;
  });

  addAnswerBtn.addEventListener("click", addAnswer);

  addQuestionBtn.addEventListener("click", (e) => {
    e.preventDefault();
    questionsPage.style.display = "none";
    addQuestionPage.style.display = "block";
    fillCategories();
    editingQuestion = null;
    answersContainer.innerHTML = "";
    addAnswer();
    document.getElementById("questionTextarea").value = "";
    multiCorrectCheckbox.checked = false;
  });

  document.getElementById("backBtn").addEventListener("click", (e) => {
    e.preventDefault();
    addQuestionPage.style.display = "none";
    questionsPage.style.display = "block";
    editingQuestion = null;
  });

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    const questionText = document
      .getElementById("questionTextarea")
      .value.trim();
    const answers = Array.from(answersContainer.querySelectorAll("input"))
      .map((i) => i.value)
      .filter((v) => v.trim() !== "");

    if (!questionText) return alert("Please enter a question!");
    if (answers.length === 0) return alert("Please add at least one answer!");

    const selectedCategory = categorySelect.value;
    const selectedSubcategory = subcategorySelect.value;
    const catObj = data.find((c) => c.category === selectedCategory);
    if (!catObj) return alert("Category not found!");
    const subcatObj = catObj.subcategories.find(
      (s) => s.name === selectedSubcategory
    );
    if (!subcatObj) return alert("Subcategory not found!");

    const correctIndexes = [];
    answersContainer.querySelectorAll(".answer-item").forEach((div, idx) => {
      if (div.classList.contains("selected")) correctIndexes.push(idx);
    });

    const questionObj = {
      question: questionText,
      answers,
      multi: multiCorrectCheckbox.checked,
      correctIndexes: multiCorrectCheckbox.checked ? correctIndexes : undefined,
      correctIndex: !multiCorrectCheckbox.checked
        ? correctIndexes[0]
        : undefined,
    };

    if (editingQuestion) {
      const index = subcatObj.questions.indexOf(editingQuestion);
      subcatObj.questions[index] = questionObj;
      editingQuestion = null;
    } else {
      subcatObj.questions.push(questionObj);
    }

    localStorage.setItem("quizData", JSON.stringify(data));

    form.reset();
    answersContainer.innerHTML = "";
    addAnswer();
    subcategorySelect.disabled = true;
    addQuestionPage.style.display = "none";
    questionsPage.style.display = "block";
    renderQuestions();

    const messageDiv = document.createElement("div");
    messageDiv.textContent = "Question added successfully!";
    messageDiv.style.position = "fixed";
    messageDiv.style.top = "20px";
    messageDiv.style.right = "20px";
    messageDiv.style.backgroundColor = "#4caf50";
    messageDiv.style.color = "#fff";
    messageDiv.style.padding = "10px 20px";
    messageDiv.style.borderRadius = "8px";
    messageDiv.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
    messageDiv.style.zIndex = 2000;
    document.body.appendChild(messageDiv);
    setTimeout(() => messageDiv.remove(), 3000);
  });

  // ===== Exam code =====
  const examSubcategory = document.getElementById("examSubcategory");
  const questionsContainer = document.getElementById("questionsContainer");
  const questionsList = document.getElementById("questionsList");
  const selectAllBtn = document.getElementById("selectAllBtn");
  const randomBtn = document.getElementById("randomBtn");
  const numQuestionsInput = document.getElementById("numQuestions");

  const questionsData = {
    html: [
      "What is HTML?",
      "What is the purpose of <head> tag?",
      "What is difference between div and span?",
    ],

    css: [
      "What is a closure?",
      "Explain async/await in JavaScript.",
      "What is event delegation?",
      "Difference between var, let and const?",
    ],

    js: [
      "What is a closure?",
      "Explain async/await in JavaScript.",
      "What is event delegation?",
      "Difference between var, let and const?",
    ],
  };

  examSubcategory.addEventListener("change", () => {
    const sub = examSubcategory.value;
    questionsList.innerHTML = "";

    if (sub && questionsData[sub]) {
      questionsContainer.style.display = "block";
      questionsData[sub].forEach((q, index) => {
        const div = document.createElement("div");
        div.innerHTML = `
          <input type="checkbox" class="questionCheck" value="${q}" id="q${index}">
          <label for="q${index}">${q}</label>
        `;
        questionsList.appendChild(div);
      });
    } else {
      questionsContainer.style.display = "none";
    }
  });

  selectAllBtn.addEventListener("click", () => {
    const checkboxes = document.querySelectorAll(".questionCheck");
    const allChecked = Array.from(checkboxes).every((ch) => ch.checked);
    checkboxes.forEach((ch) => (ch.checked = !allChecked));
    selectAllBtn.textContent = allChecked ? "Select All" : "Unselect All";
  });

  randomBtn.addEventListener("click", () => {
    const selected = Array.from(
      document.querySelectorAll(".questionCheck:checked")
    ).map((ch) => ch.value);
    const num = parseInt(numQuestionsInput.value);
    if (isNaN(num) || num <= 0) {
      alert("Enter a valid number of questions!");
      return;
    }
    if (num > selected.length) {
      alert("You selected fewer questions than the number entered!");
      return;
    }
    const shuffled = selected.sort(() => 0.5 - Math.random());
    const chosen = shuffled.slice(0, num);
    alert("Randomly selected questions:\n\n" + chosen.join("\n"));
  });
});






// search -------------------------------------------------------------------
  const searchInput = document.querySelector('input[type="search"]');
  const tableRows = document.querySelectorAll("table tbody tr");

  searchInput.addEventListener("keyup", function () {
    const filter = searchInput.value.toLowerCase();

    tableRows.forEach((row) => {
      const rowText = row.textContent.toLowerCase();

      if (rowText.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });



  // pagination ----------------------------------------------
function setupPaginationForAllTables(rowsPerPage = 8) {
  document.querySelectorAll("table.paginated").forEach((table) => {
    const tbody = table.querySelector("tbody");
    const rows = tbody.querySelectorAll("tr");

    let pagination = document.createElement("div");
    pagination.className = "pagination mt-3 d-flex gap-2 align-items-center flex-wrap";
    table.insertAdjacentElement("afterend", pagination);

    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function displayRows(page) {
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      rows.forEach((row, i) => {
        row.style.display = (i >= start && i < end) ? "" : "none";
      });
    }

    function renderPagination() {
      pagination.innerHTML = "";

      // Prev Button
      const prevBtn = document.createElement("button");
      prevBtn.textContent = "Prev";
      prevBtn.className = "btn btn-sm btn-dark p-3";
      prevBtn.disabled = currentPage === 1;
      prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
          currentPage--;
          displayRows(currentPage);
          renderPagination();
        }
      });
      pagination.appendChild(prevBtn);

      let startPage = Math.max(1, currentPage - 1);
      let endPage = Math.min(totalPages, currentPage + 1);

      if (currentPage === 1) endPage = Math.min(3, totalPages);
      if (currentPage === totalPages) startPage = Math.max(1, totalPages - 2);

      for (let i = startPage; i <= endPage; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.className = "btn btn-sm btn-dark p-3";

        if (i === currentPage) {
          btn.style.backgroundColor = "#199902ff";
          btn.style.color = "black";
          btn.style.padding = "1rem 1.5rem";
          btn.style.borderRadius = "5px";
        }

        btn.addEventListener("click", () => {
          currentPage = i;
          displayRows(currentPage);
          renderPagination();
        });

        pagination.appendChild(btn);
      }

      // Next Button
      const nextBtn = document.createElement("button");
      nextBtn.textContent = "Next";
      nextBtn.className = "btn btn-sm btn-dark p-3";
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.addEventListener("click", () => {
        if (currentPage < totalPages) {
          currentPage++;
          displayRows(currentPage);
          renderPagination();
        }
      });
      pagination.appendChild(nextBtn);
    }

    displayRows(currentPage);
    renderPagination();
  });
}

setupPaginationForAllTables(8);
