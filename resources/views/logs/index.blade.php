@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">📋 User Activity Logs</h4>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Route Name</th>
                        <th>URL</th>
                        <th>Method</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>Platform</th>
                        <th>Data</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="log-row">
                            <td class="text-nowrap">{{ optional($log->causer)->name ?? 'System' }}</td>
                            <td class="text-nowrap text-success fw-bold">{{ $log->description }}</td>
                            <td class="text-nowrap">{{ $log->log_name }}</td>
                            <td class="text-nowrap">{{ $log->properties['route_name'] ?? '-' }}</td>
                            <td style="max-width: 200px;">
                                @php
                                    $url = $log->properties['url'] ?? '-';
                                    $shortUrl = Str::limit($url, 10);
                                @endphp
                                <div class="show-toggle" data-full="{{ $url }}">
                                    {{ $shortUrl }}
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $log->properties['method'] ?? '-' }}</td>
                            <td class="text-nowrap">{{ $log->properties['ip'] ?? '-' }}</td>
                            <td style="max-width: 200px;">
                                @php
                                    $agent = $log->properties['user_agent'] ?? '-';
                                    $shortAgent = Str::limit($agent, 50);
                                @endphp
                                <div class="show-toggle" data-full="{{ $agent }}">
                                    {{ $shortAgent }}
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $log->properties['platform'] ?? '-' }}</td>
                            <td style="max-width: 250px;">
                                @php
                                    $json = json_encode($log->properties['data'] ?? [], JSON_PRETTY_PRINT);
                                    $short = Str::limit($json, 50);
                                @endphp
                                <pre class="m-0 text-wrap show-data" style="white-space: pre-wrap;" data-full="{{ $json }}">
                                    {{ $short }}
                                </pre>
                            </td>
                            <td class="text-nowrap">{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        <tr class="log-details" style="display:none;">
                            <td colspan="11">
                                <div class="expanded-info">
                                    <strong>Full URL:</strong> {{ $log->properties['url'] ?? '-' }}<br>
                                    <strong>User Agent:</strong> {{ $log->properties['user_agent'] ?? '-' }}<br>
                                    <strong>Data:</strong><pre>{{ json_encode($log->properties['data'] ?? [], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">No activity logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $logs->links() }}
        </div>
    </div>
@endsection

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Toggle row expansion on click
        $(document).on('click', '.log-row', function () {
            var $nextRow = $(this).next('.log-details');

            if ($nextRow.is(':visible')) {
                $nextRow.hide();
            } else {
                $('.log-details').hide(); // Hide all other expanded rows
                $nextRow.show();
            }
        });
    });
</script>
