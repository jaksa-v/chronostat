import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, Project } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Project',
        href: '/projects',
    },
];

export default function ProjectPage({ project }: { project: Project }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={project.name} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <h1 className="text-2xl font-bold">{project.name}</h1>
            </div>
        </AppLayout>
    );
}
