-- Table: challenge_stack.user
INSERT INTO challenge_stack.user (id, firstname, lastname, email, password, token, confirmation, role)
VALUES (1, 'John', 'Doe', 'john@example.com', 'password123', 'token123', true, 'user');

-- Table: challenge_stack.page
INSERT INTO challenge_stack.page (id, pagetitle, pageauthor, content, user_id)
VALUES (1, 'Welcome', 'Admin', 'Welcome to our website!', 1);

-- Table: challenge_stack.template
INSERT INTO challenge_stack.template (id, color, font_family, font_size, page_id)
VALUES (1, '#FFFFFF', 'Arial', 12, 1);

-- Table: challenge_stack.pagememento
INSERT INTO challenge_stack.pagememento (id, pagetitle, content, slug, page_id, save_date)
VALUES (1, 'Welcome', 'Initial content', 'welcome', 1, '2023-08-25');

-- Table: challenge_stack.menu
INSERT INTO challenge_stack.menu (id, name, items, active)
VALUES (1, 'Main Menu', ARRAY['Home', 'About', 'Services'], true);

-- Table: challenge_stack.categorie
INSERT INTO challenge_stack.categorie (id, title)
VALUES (1, 'Technology');

-- Table: challenge_stack.article
INSERT INTO challenge_stack.article (id, articletitle, content, user_id, articleauthor, slug, categorie_id)
VALUES (1, 'Introduction to Technology', 'This is an introduction to technology.', 1, 'Admin', 'intro-tech', 1);

-- Table: challenge_stack.articlecategorie
INSERT INTO challenge_stack.articlecategorie (article_id, categorie_id)
VALUES (1, 1);

-- Table: challenge_stack.comments
INSERT INTO challenge_stack.comments (id, content, date, idpage, comment_author, reported, article_id)
VALUES (1, 'Great article!', '2023-08-25 12:00:00', 1, 'User123', false, 1);
