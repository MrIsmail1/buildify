-- Insérer des données fictives pour la table "user"
INSERT INTO challenge_stack."user" (firstname, lastname, email, password, token, confirmation, role)
VALUES ('John', 'Doe', 'john@example.com', 'hashed_password', 'token123', true, 'user'),
       ('Jane', 'Smith', 'jane@example.com', 'hashed_password', 'token456', true, 'user'),
       ('Alex', 'Johnson', 'alex@example.com', 'hashed_password', 'token789', true, 'admin');

-- Insérer des données fictives pour la table "categorie"
INSERT INTO challenge_stack.categorie (title)
VALUES ('Science'), ('Technology'), ('Art');

-- Insérer des données fictives pour la table "article"
INSERT INTO challenge_stack.article (articletitle, content, user_id, articleauthor, slug, categorie_id)
VALUES ('Introduction to Science', 'In this article, we explore the fundamental principles of science and its importance in our daily lives. Science is the systematic study of the natural world...', 1, 'John Doe', 'intro-to-science', 1),
       ('Latest Tech Trends', 'Stay updated with the latest trends in technology. From artificial intelligence to blockchain, we cover the most exciting developments in the tech world...', 1, 'Jane Smith', 'tech-trends', 2),
       ('The Art of Expression', 'Artistic expression takes various forms, including painting, sculpture, music, and literature. In this article, we delve into the rich history and diverse...', 2, 'Alex Johnson', 'art-expression', 3);

-- Insérer des données fictives pour la table "comments"
INSERT INTO challenge_stack.comments (content, idpage, comment_author, reported, article_id)
VALUES ('Great article! I learned a lot.', 1, 'User123', false, 1),
       ('Impressive insights. Keep it up!', 1, 'User456', false, 1),
       ('I'm excited about these tech trends.', 2, 'User789', false, 2),
       ('Art is truly a universal language.', 3, 'User123', false, 3);

-- Insérer des données fictives pour la table "page"
INSERT INTO challenge_stack.page (pagetitle, pageauthor, content, slug, user_id, meta_description, seo_title)
VALUES ('About Us', 'Admin', 'Welcome to our website! Learn more about our team and mission.', 'about-us', 1, 'Get to know our organization.', 'About Our Company'),
       ('Tech News', 'Jane Smith', 'Stay updated with the latest tech news and innovations.', 'tech-news', 1, 'Stay informed about technology trends.', 'Latest Tech News');

-- Insérer des données fictives pour la table "template"
INSERT INTO challenge_stack.template (color, font_family, font_size, page_id)
VALUES ('#333', 'Arial', 14, 1),
       ('#E53935', 'Roboto', 16, 2);

-- Insérer des données fictives pour la table "menu"
INSERT INTO challenge_stack.menu (name, items, active)
VALUES ('Main Menu', ARRAY['Home', 'Articles', 'About Us'], true),
       ('Technology Categories', ARRAY['Artificial Intelligence', 'Blockchain', 'Internet of Things'], true),
       ('Art Categories', ARRAY['Painting', 'Sculpture', 'Music'], true);
