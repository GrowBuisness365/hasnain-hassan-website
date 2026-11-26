-- HassanEngine content management storage.
-- Run in the Supabase SQL Editor for the project connected to Vercel.

create table if not exists public.site_content (
    section_key text primary key,
    payload jsonb not null,
    updated_at timestamptz not null default now(),
    constraint site_content_key_allowed check (
        section_key in (
            'posts', 'categories', 'team', 'services', 'projects',
            'topics', 'testimonials', 'faqs', 'seo_pages', 'sections', 'footer_links'
        )
    )
);

alter table public.site_content enable row level security;
revoke all on table public.site_content from anon, authenticated;
grant select, insert, update, delete on table public.site_content to service_role;

create or replace function public.site_content_touch_updated_at()
returns trigger
language plpgsql
as $$
begin
    new.updated_at = now();
    return new;
end;
$$;

drop trigger if exists site_content_updated_at on public.site_content;
create trigger site_content_updated_at
before update on public.site_content
for each row execute function public.site_content_touch_updated_at();
