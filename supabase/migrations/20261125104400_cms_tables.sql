-- HassanEngine extended CMS tables.
-- Run in the Supabase SQL Editor AFTER 20261117121221_site_content.sql.
-- Does not modify the existing site_content table.

create table if not exists public.admin_users (
    id uuid primary key default gen_random_uuid(),
    email text unique not null,
    password_hash text not null,
    role text not null default 'editor' check (role in ('admin', 'editor')),
    is_active boolean not null default true,
    created_at timestamptz not null default now(),
    last_login_at timestamptz
);

alter table public.admin_users enable row level security;
revoke all on table public.admin_users from anon, authenticated;
grant select, insert, update, delete on table public.admin_users to service_role;

create table if not exists public.contact_messages (
    id uuid primary key default gen_random_uuid(),
    name text not null,
    email text not null,
    phone text,
    topic text not null,
    message text not null,
    status text not null default 'new' check (status in ('new', 'read', 'replied', 'archived')),
    read_at timestamptz,
    replied_at timestamptz,
    created_at timestamptz not null default now(),
    ip_address text,
    user_agent text
);

alter table public.contact_messages enable row level security;
revoke all on table public.contact_messages from anon, authenticated;
grant select, insert, update, delete on table public.contact_messages to service_role;

create table if not exists public.audit_logs (
    id uuid primary key default gen_random_uuid(),
    admin_id uuid references public.admin_users(id) on delete set null,
    action text not null,
    target_type text not null,
    target_id text,
    details jsonb,
    created_at timestamptz not null default now()
);

alter table public.audit_logs enable row level security;
revoke all on table public.audit_logs from anon, authenticated;
grant select, insert on table public.audit_logs to service_role;

create table if not exists public.pages (
    id uuid primary key default gen_random_uuid(),
    slug text unique not null,
    title text not null,
    content jsonb not null default '{}',
    status text not null default 'published' check (status in ('published', 'draft', 'archived')),
    created_at timestamptz not null default now(),
    updated_at timestamptz not null default now()
);

alter table public.pages enable row level security;
revoke all on table public.pages from anon, authenticated;
grant select, insert, update, delete on table public.pages to service_role;

create or replace function public.touch_updated_at()
returns trigger
language plpgsql
as $$
begin
    new.updated_at = now();
    return new;
end;
$$;

drop trigger if exists pages_updated_at on public.pages;
create trigger pages_updated_at
before update on public.pages
for each row execute function public.touch_updated_at();
