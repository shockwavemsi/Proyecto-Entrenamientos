const ul = document.getElementById("menu");

fetch("/menu.json")
    .then((res) => res.json())
    .then((data) => {
        data.forEach((item) => {
            const li = document.createElement("li");

            // Enlace principal
            li.innerHTML = `<a href="${item.url}">${item.name}</a>`;

            // Si tiene submenús
            if (item.children && item.children.length > 0) {
                const subUl = document.createElement("ul");

                item.children.forEach((sub) => {
                    const subLi = document.createElement("li");
                    subLi.innerHTML = `<a href="${sub.url}">${sub.name}</a>`;
                    subUl.appendChild(subLi);
                });

                li.appendChild(subUl);
            }

            ul.appendChild(li);
        });
    })
    .catch((err) => console.error("Error cargando el menú:", err));
