# HassanEngine SEO Implementation Report

Implementation date: 2026-11-18

## Completed changes

- **`SEO-AUDIT.md`** — replaced the stale preliminary audit with a source/configuration audit that documents Vercel PHP routing, existing SEO implementation, crawler and article defects, duplicate layouts, risks, and verification limits.
- **`api/index.php`, `xml-sitemap.php`, `robots.txt`** — routed `/robots.txt` and `/sitemap.xml` to distinct responses. Robots now returns plain text. The XML sitemap lists the homepage, selected core pages, and each configured article. It no longer invents a `lastmod` value for every URL.
- **`includes/data/content.php`, `blog-detail.php`** — article detail now selects the article by its `slug` query parameter; the legacy detail URL still loads the first article. Invalid slugs return 404. The page metadata and canonical URL are selected per article. Generic filler copy and an unrelated quote/image were removed instead of being presented as article material.
- **`blog.php`, `blog-classic.php`, `blog-sidebar.php`, `components/cards.php`, `components/sidebar-widgets.php`, `components/sidebar-cart.php`** — listing and related-post links now lead to the matching article. The main blog listing is generated from the article dataset and includes excerpts, authors, categories, and dates already present in that data. Duplicate archive layouts remain noindex.
- **`includes/head.php`, `components/page-title.php`** — page-specific title/description overrides are preserved; canonical URLs can be selected per article; Open Graph and Twitter image metadata use the page image when available; the shared page-title band uses an H1.
- **`includes/schema.php`** — removed hard-coded address and generic social profile claims from publisher schema; BlogPosting uses the selected article URL/date/author instead of a fixed fallback date; breadcrumb links use the extensionless canonical path.
- **`includes/config.php`** — changed service page metadata to describe engineering topics rather than imply consulting offers.
- **`not-found.php`** — sends HTTP 404 when served directly as well as through the Vercel router.

## Verification performed

- PHP syntax check passed for all 45 PHP files.
- Started PHP's local development server using `api/index.php` and checked local responses:
  - `/robots.txt`: HTTP 200, `text/plain`, expected robots directives.
  - `/sitemap.xml`: HTTP 200, `application/xml`; XML parsed successfully and contained 18 URLs, including all 12 configured articles.
  - `/blog-detail?slug=postgres-indexing-in-practice`: HTTP 200; canonical included the selected slug and JSON-LD parsed with the matching `BlogPosting` headline.
  - Unknown route and unknown article slug: HTTP 404.
- The available web fetch could not access the production website. These local checks do not verify deployed Vercel behavior.

## 2026-11-18 design and performance updates

- Interior pages now share an engineering-themed hero with page-specific lightweight SVG artwork and breadcrumbs, using the homepage's navy, cyan, and red palette.
- Rebuilt the homepage, about page, and topic page around the engineering journal. Duplicate homepage and service-detail routes now permanently redirect to canonical pages. Contributor pages now use contributor data instead of unrelated stock team layouts.
- Corrected topic counts to match the current article dataset and removed an unverified newsletter FAQ promise. Contributor email links use the configured contact email.
- Added `.vercelignore` rules so deployment includes optimized JPEGs and the few still-used author images while omitting unused full-size JPEG originals.
- Added 10 topic-specific SVG illustrations totaling roughly 16 KB and removed a duplicate project-detail slider that repeated stock imagery.
- Deployed to the production Vercel project on 2026-11-18; Vercel reported `READY` and aliased it to `https://hasnain-hassan.vercel.app`. Deployment protection is enabled. No PageSpeed/Core Web Vitals score is claimed for this pass.
- Confirmed the production Vercel project has hidden `SUPABASE_URL`, `SUPABASE_SECRET_KEY`, and `CMS_ADMIN_PASSWORD_HASH` variables. Vercel does not expose the secret values to local `env pull`/`env run`, so a direct Supabase query could not be completed in this session; the content store retains its bundled-content fallback.

## Remaining issues and owner steps

- Article data currently has excerpts but no full article bodies. The detail page consequently stays short; add and review original body content before treating these pages as substantial search landing pages.
- Confirm that article names, authors, dates, project descriptions, contributor profiles, contact information, and actual offerings in `includes/data/content.php` and `includes/config.php` are factual. The audit did not invent or independently verify those claims.
- Category links currently lead to the main article listing; there are no real category archive pages. The sitemap intentionally omits category URLs.
- Verify form delivery and file-backed storage on Vercel; serverless persistence and mail configuration were not tested.
- After deployment, check production status/content types for robots and sitemap, validate structured data with Google's Rich Results Test, run PageSpeed Insights for mobile and desktop, and submit the sitemap in Search Console. Search Console ownership and indexing were not verified.
- The 2026-11-18 design changes are deployed to production; anonymous fetch and PageSpeed checks remain outstanding.
- Simplified every page to one responsive navigation with an accessible native mobile menu, and rebuilt the article, FAQ, project, and contact sections with subject-matched links, illustrations, and copy.
- Pages now use native HTML controls without the theme's jQuery, jQuery UI, slider, animation, popup, and validation bundles. The removed global vendor scripts totaled about 1.1 MB uncompressed. Those unused JS and plugin CSS assets are also omitted from Vercel deployments.
- Replaced the theme's serial CSS `@import` chain with direct stylesheet links; removed unused plugin styles, the external Google Fonts request, a duplicate Google Tag Manager loader, and the contact page's external map iframe.
- Added a 15-second per-instance content cache for Supabase reads. A new read now uses millisecond connection/overall timeouts and falls back to bundled content or recent cached content when Supabase is slow or unavailable.
- Updated page titles/descriptions and Open Graph images by page type. Topic links filter the article archive; project links now open the matching project, each contributor has a canonical profile URL, and the sitemap includes project and contributor detail pages.
- Updated JSON-LD so article, FAQ, contributor profile, project listing, and project detail schema describes the content shown on that page.

## Manual owner actions

1. Review factual content and supply article bodies.
2. Verify the two crawler endpoints and a valid/invalid article URL on the protected deployed domain.
3. Run PageSpeed Insights and submit `https://hasnain-hassan.vercel.app/sitemap.xml` in Search Console.

## Performance follow-up

- Generated optimized JPEG copies for 36 large, referenced images and changed page/data references to use them while preserving the original image files. Across those files, total image bytes fell from about 12.6 MB to 2.2 MB (about 83%). The copies use JPEG quality 80 and a maximum 1800 px longest edge; a visual comparison of a large banner showed no material layout or content change.
- Added lazy loading and asynchronous decoding to below-the-fold article, project, team, service, and testimonial card images. The CSS-only homepage hero needs no image request; article hero images use high fetch priority.
- Removed the unused global JavaScript bundle and external font request; system fonts and native HTML controls reduce network requests and client-side work.
- Added a one-week browser/CDN cache policy for static assets in `vercel.json`.
- Local rendering checks found no missing image files on the homepage, blog listing, article detail, or project listing. These checks do not measure Core Web Vitals or deployed cache headers; verify those after deployment.
- Replaced the real-estate homepage hero with a centered typographic design, CSS-only dark gradient/grid treatment, concise engineering copy, and article/project calls to action. Added “Articles” as a top-level navigation link and introduced matching HassanEngine SVG wordmarks for light and dark backgrounds plus a matching favicon.
- Unified the three footer layouts into one responsive site footer with the brand, verified site destinations, configured email, and the existing protected newsletter form. Removed placeholder footer links and unconfirmed address/social details from the footer.
- Expanded the footer with eight site links, four dynamic recent-article links, and an email icon/link. Added a server-rendered, password-protected `/admin` content manager with CSRF protection and a Supabase Postgres persistence layer. The editor supports articles (including body paragraphs), projects, topics, categories, contributors, testimonials, FAQs, SEO metadata, footer links, and homepage/footer copy. Added database schema and [CMS setup instructions](CMS-SETUP.md). The dashboard requires server-side Supabase credentials and a password hash before it can save; never expose the Supabase secret key in browser code.
- Replaced the homepage's fake app-download/rating panel with an article call to action. Article body paragraphs saved through the CMS are now rendered as escaped text on article detail pages. The optional CMS database request has short timeouts so an unavailable database falls back to bundled content quickly.
