document.addEventListener('DOMContentLoaded', function () {
  const categorySelect = document.getElementById('category-select');
  const articlesContainer = document.getElementById('filtered-articles');
  const articleData = JSON.parse(
    articlesContainer.getAttribute('data-articles')
  );

  categorySelect.addEventListener('change', function () {
    const selectedCategoryId = categorySelect.value;
    let filteredArticleHtml = '';

    for (const article of articleData) {
      if (!selectedCategoryId || article.categorie_id == selectedCategoryId) {
        filteredArticleHtml += `
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">${article.articletitle}</h3>
                            <p class="text-gray-600 text-sm mb-2">Auteur : ${article.articleauthor}</p>
                            <p class="text-gray-600 text-sm mb-2">Date de modification : ${article.last_modified}</p>
                            <p class="text-gray-700 text-sm">${article.content}</p>
                            <a href="article/singlearticle?id=${article.id}">Voir l'article</a>
                        </div>
                    </div>
                `;
      }
    }

    articlesContainer.innerHTML = filteredArticleHtml;
  });

  categorySelect.dispatchEvent(new Event('change'));
});
