INSERT INTO challenge_stack.categorie (id, title)
VALUES
    (1, 'Technology'),
    (2, 'Science'),
    (3, 'Travel'),
    (4, 'Food');

-- Insert fake articles
INSERT INTO challenge_stack.article (id, articletitle, content, user_id, articleauthor, slug, last_published, categorie_id)
VALUES
    (1, 'Introduction to Artificial Intelligence', 'In this article, we explore the basics of AI.', 1, 'John Doe', 'intro-to-ai', NOW(), 1),
    (2, 'The Wonders of Space Exploration', 'Discover the latest advancements in space exploration.', 1, 'Jane Smith', 'space-exploration', NOW(), 2),
    (3, 'A Culinary Journey: Exploring Global Cuisines', 'Embark on a gastronomic adventure around the world.', 1, 'John Doe', 'global-cuisines', NOW(), 4);

-- Insert fake article categories
INSERT INTO challenge_stack.articlecategorie (article_id, categorie_id)
VALUES
    (1, 1),
    (2, 2),
    (3, 4);

-- Insert fake comments
INSERT INTO challenge_stack.comments (id, content, idpage, comment_author, reported, article_id)
VALUES
    (1, 'Great article!', 1, 'Alice', false, 1),
    (2, 'I enjoyed reading this.', 2, 'Bob', false, 2),
    (3, 'Looking forward to more content.', 3, 'Eve', false, 3);

-- Insert fake pages
INSERT INTO challenge_stack.page (id, pagetitle, pageauthor, content, slug, user_id, meta_description, seo_title)
VALUES
    (1, 'About Us', 'John Doe', 'We are a team of passionate writers.', 'about-us', 1, 'Learn more about our team.', 'About Us - Challenge Stack'),
    (2, 'Contact', 'Jane Smith', 'Get in touch with us.', 'contact', 1, 'Contact us for inquiries.', 'Contact Us - Challenge Stack');

-- Insert fake templates
INSERT INTO challenge_stack.template (id, color, font_family, font_size, page_id)
VALUES
    (1, '#3498db', 'Arial, sans-serif', 14, 1),
    (2, '#e74c3c', 'Georgia, serif', 16, 2);

-- Insert fake page mementos
INSERT INTO challenge_stack.pagememento (id, pagetitle, content, slug, page_id, save_date)
VALUES
    (1, 'About Us (Original)', 'This is the original version of the About Us page.', 'about-us-original', 1, '2023-08-25'),
    (2, 'Contact (Original)', 'This is the original version of the Contact page.', 'contact-original', 2, '2023-08-25');

-- Insert fake menu
INSERT INTO challenge_stack.menu (id, name, items, active)
VALUES
    (1, 'Main Menu', ARRAY['about-us', 'contact'], true);