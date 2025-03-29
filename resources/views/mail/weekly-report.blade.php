<x-mail::message>
# Your Weekly Report

Hi {{ $user->name }}, here is the summary of time logged per project this week:

@forelse ($projects as $project)
## {{ $project->name }}

Total this week:
{{ $project->weekly_total_formatted }}

**Entries:**
<ul>
@foreach ($project->timeEntries->sortBy('start_time') as $timeEntry)
    <li>{{ $timeEntry->start_time->format('M d, H:i') }} - {{ $timeEntry->end_time ? $timeEntry->end_time->format('H:i') : 'Ongoing' }} ({{ $timeEntry->duration_formatted }})</li>
@endforeach
</ul>

---
@empty
<x-mail::panel>
No time entries logged this week.
</x-mail::panel>
@endforelse

<x-mail::button :url="config('app.url') . '/dashboard'">
Go to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
