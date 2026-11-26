# HassanEngine content manager setup

The dashboard is available at `/admin`. It stores editable content in Supabase Postgres. Until the database and password hash are configured, the dashboard stays read-only and public pages use the bundled PHP content.

## Configure Supabase

1. Create a Supabase project, or connect Supabase through the Vercel Marketplace integration.
2. In the Supabase SQL Editor, run [`database/supabase-schema.sql`](database/supabase-schema.sql).
3. Add these environment variables to the Vercel project for each environment that should use the dashboard:
   - `SUPABASE_URL`: the project URL, such as `https://your-project.supabase.co`.
   - `SUPABASE_SECRET_KEY`: the Supabase secret key (or legacy `service_role` key). Keep it server-side; never put it in browser JavaScript or a public `NEXT_PUBLIC_` variable.
   - `CMS_ADMIN_PASSWORD_HASH`: a PHP password hash for the dashboard password.
4. Redeploy after setting environment variables. Open `/admin` and sign in with the password used to create the hash.

Generate a hash in a trusted terminal with PHP. It prompts for the password and prints only the hash:

```sh
php -r 'echo password_hash(readline("Admin password: "), PASSWORD_DEFAULT), PHP_EOL;'
```

Copy the resulting hash into `CMS_ADMIN_PASSWORD_HASH`; do not put the plain password in the environment variable. Store the Supabase secret in Vercel's server environment settings, not in this repository.

## Editing content

The dashboard has JSON editors for articles, projects, contributors, topic cards, FAQs, testimonials, categories, SEO page titles/descriptions, footer navigation, and section copy. Use valid JSON and save a whole group at once. Footer navigation is a JSON object of labels and internal paths, for example `{"Articles":"blog.php","Contact":"contact.php"}`. Article entries require `slug`, `title`, `excerpt`, `author`, `date`, and `image`; optional `body` is an array of paragraphs, for example:

```json
{
  "slug": "example-article",
  "title": "Example article",
  "excerpt": "A concise summary for listings and search previews.",
  "category": "Engineering",
  "author": "Author name",
  "date": "2026-11-17",
  "read": "5 min read",
  "image": "assets/images/resource/example.optimized.jpg",
  "tags": ["Engineering"],
  "body": ["First reviewed paragraph.", "Second reviewed paragraph."]
}
```

Section-copy keys currently used on the home page include `home.hero.eyebrow`, `home.hero.title`, `home.hero.accent`, `home.hero.description`, `home.story.title`, `home.story.description`, `home.topics.title`, `home.digest.title`, `home.digest.description`, `home.projects.title`, `home.contributors.title`, `home.contact.form_title`, `home.contact.title`, `home.testimonials.title`, and `home.articles.title`. Footer copy keys are `footer.about`, `footer.articles_title`, `footer.newsletter_title`, and `footer.newsletter_note`. Only defined template fields are rendered; use code changes for structural layout/design changes. Keep article and page titles accurate, descriptions specific, and text original. Preview changes on the public pages and review links/images before publishing them.

If the database is unavailable, public pages fall back to the included content. A save reports an error rather than silently writing to temporary serverless storage.
