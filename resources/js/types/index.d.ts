import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };

    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;

    [key: string]: unknown; // This allows for additional properties...
}

export interface Project {
    id: number;
    name: string;
    description: string;
    user_id: number;
    created_at: string;
    updated_at: string;
    time_entries_sum_duration?: number;

    [key: string]: unknown;
}

export interface TimeEntry {
    id: number;
    project_id: number;
    user_id: number;
    start_time: string;
    end_time: string;
    duration: number;
    duration_formatted: string;
    created_at: string;
    updated_at: string;
}
