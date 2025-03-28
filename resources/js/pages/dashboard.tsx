import AppLayout from '@/layouts/app-layout';
import { formatTime } from '@/lib/utils';
import { type BreadcrumbItem, Project } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ projects }: { projects: Project[] }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    {projects.map((project) => (
                        <div
                            key={project.id}
                            className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border p-4"
                        >
                            <div className="flex items-end justify-between">
                                <h4 className="text-2xl font-semibold">{project.name}</h4>
                                <Link href={`/projects/${project.id}`}>
                                    <span className="hover:underline">See more</span>
                                </Link>
                            </div>
                            <div className="mt-2 flex items-end gap-x-4">
                                <h4 className="">Total: </h4>
                                <span>{formatTime(project.time_entries_sum_duration || 0)}</span>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
