# HassanEngine SEO Audit

Audit date: 2026-11-17 (workspace context)

## Project and deployment

- The project is a PHP site with shared templates under `includes/` and `components/`, plus static assets under `assets/`.
- `vercel.json` configures `api/index.php` with `vercel-php@0.9.0` and sends site requests through that front controller. The router serves PHP files at both extensionless and `.php` paths.
- The project also includes Apache `.htaccess` rules for local Apache hosting. Those rules do not define the Vercel behavior.
- `package.json` has only `@vercel/analytics`; no build or article generation script exists. No Composer configuration or database-backed content source is present. Article data is a PHP array in `includes/data/content.php`.
- PHP execution was verified from configuration/source, not from a live deployment request. No deployment or external crawl was performed.

## Existing SEO implementation

- `includes/config.php` holds global site values and a page metadata map.
- `includes/head.php` emits titles, descriptions, robots, canonicals, Open Graph, Twitter metadata, Google tags, and schema.
- `includes/schema.php` builds JSON-LD. It currently emits Organization and WebSite nodes globally and page-specific nodes.
- `api/index.php` routes both `/sitemap.xml` and `/robots.txt` to `xml-sitemap.php`.
- `xml-sitemap.php` currently emits XML for either route. It lists page keys from the metadata table, not individual article URLs.
- A static `robots.txt` also exists and disagrees with the dynamic response; the route means Vercel does not serve that static file for `/robots.txt`.
- The sitemap uses the current date for every URL, including pages with no known modification date.

## Findings and risks

1. **Robots endpoint is incorrect on Vercel:** `/robots.txt` is routed to `xml-sitemap.php`, which returns XML with an XML content type. The checked-in plain text robots file is not used by that route.
2. **Sitemap is incomplete and inaccurate:** published article slugs are omitted; metadata keys can include layout variants and synthetic detail pages; generated URLs do not consistently reflect the `.php` URLs or aliases actually served; every entry receives a fabricated current `lastmod`.
3. **Article detail is not a set of article pages:** `blog-detail.php` always selects `$posts[0]`, so all article links reach the same article. It renders generic template copy rather than article-specific body content. Article data has titles, excerpts, authors, dates, images, and tags but no full article content.
4. **Article structured data is misleading:** `schema.php` uses a fixed fallback publication date and author. The article schema URL is `/blog-detail.php` without a selected slug, and article metadata is not selected from the requested article.
5. **Canonical URLs and aliases need a single policy:** the router serves both extensionless and `.php` variants without redirects; head canonicals use extensionless paths for most pages, while the sitemap/schema use `.php` URLs in places.
6. **Duplicate layouts:** `index-2.php`, `index-3.php`, `index04b9.php`, `blog-classic.php`, and `blog-sidebar.php` are alternate layouts or substantially similar listings. Some are marked noindex in the shared head, but index-2 and index-3 are indexable.
7. **Metadata coverage is incomplete:** shared metadata falls back to homepage metadata for unknown page keys. Some configured descriptions and titles are generic, and many detail pages have no true page-specific resource selection.
8. **Schema uses unsupported or unverified claims:** a generic Organization, postal address, contact facts, contributor identities, service claims, and project data are emitted from configuration/template data. Site ownership and factual accuracy require the owner to confirm these represent the real publisher and offerings.
9. **On-page content still contains template material:** several pages retain generic real-estate/construction design elements, filler quotations, testimonial/client sections, dummy contact details, and template image use. These need owner-confirmed content before they can safely be represented as genuine expertise or claims.
10. **Images are not consistently optimized for SEO/accessibility:** many content images use empty alt text, and image width/height are generally absent. No systematic responsive image strategy was found.
11. **Contact forms and storage need deployment verification:** PHP form handlers and file-backed logs exist, but Vercel serverless filesystem persistence and mail delivery cannot be confirmed from local configuration alone.
12. **404 handling:** the Vercel router sets status 404 for missing paths before including `not-found.php`; confirm this with a deployed HTTP request after deployment. The `.htaccess` error path is Apache-specific.
13. **No verifiable live performance or indexing results:** PageSpeed, Rich Results Test, Search Console ownership, and live HTTP behavior have not been checked.

## Key files

- Routing/deployment: `vercel.json`, `api/index.php`, `.htaccess`
- SEO metadata/templates: `includes/config.php`, `includes/head.php`, `includes/schema.php`
- Content: `includes/data/content.php`, `blog.php`, `blog-detail.php`, listing variants
- Crawl files: `robots.txt`, `xml-sitemap.php`
- Shared site layout: `bootstrap.php`, `includes/header.php`, `includes/nav.php`, `page-footer.php`
- Forms: `contact.php`, `subscribe.php`, `includes/contact-handler.php`, `includes/form-security.php`

## Recommended implementation sequence

1. Fix robots and sitemap routing/content types; list only verified canonical public URLs and actual article pages, with no invented modification dates.
2. Resolve article pages from the existing article dataset using a stable slug parameter, generate page-specific metadata/schema/canonicals, and avoid inventing missing article body text.
3. Consolidate metadata and canonical URL policy across aliases, and noindex duplicate layouts.
4. Audit and improve alt text, intrinsic image dimensions, headings, labels, and links where intent is clear from existing content.
5. Keep service, team, organization, address, project, and testimonial claims out of structured data unless the source is demonstrably genuine.
6. Run local PHP syntax/render checks and validate generated sitemap/robots/schema. Verify live HTTP status and external performance/indexing tools after deployment; deployment is not authorized by the supplied instructions.

## Limitations

This report is a source/configuration audit of the workspace. It does not claim that the current production deployment, external tools, Search Console, Google indexing, or actual mobile performance were verified.
