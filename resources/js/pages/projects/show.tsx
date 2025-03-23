import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, Project, TimeEntry } from '@/types';
import { Head } from '@inertiajs/react';
import { format, parseISO } from 'date-fns';

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

export default function ProjectPage({ project, timeEntries }: { project: Project; timeEntries: TimeEntry[] }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={project.name} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <h1 className="text-2xl font-bold">{project.name}</h1>
                {timeEntries.length === 0 ? (
                    <p>No time entries yet.</p>
                ) : (
                    timeEntries.map((timeEntry) => (
                        <div key={timeEntry.id} className="border-sidebar-border/70 dark:border-sidebar-border overflow-hidden rounded-xl border p-4">
                            <span>{format(parseISO(timeEntry.start_time), 'MMM d, h:mm a')}</span>
                            <span> - </span>
                            <span>{format(parseISO(timeEntry.end_time), 'MMM d, h:mm a')}</span>
                            <div className="flex gap-x-2">
                                <span>Duration:</span>
                                <span>{timeEntry.duration_formatted}</span>
                            </div>
                        </div>
                    ))
                )}
            </div>
        </AppLayout>
    );
}
