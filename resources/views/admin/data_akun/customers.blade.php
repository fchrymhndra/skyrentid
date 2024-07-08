<!-- resources/views/admin/data_akun/customers.blade.php -->
@extends('admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="mb-0 text-white">Data Akun</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Jenis Member</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $customer->nama }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->no_hp }}</td>
                                    <td>
                                        <select class="form-control jenis-member" data-id="{{ $customer->id_user }}">
                                            @foreach($members as $member)
                                                <option value="{{ $member->id_member }}" {{ $customer->id_member == $member->id_member ? 'selected' : '' }}>
                                                    {{ $member->jenis_member }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>Rp {{ number_format($customer->total_transaksi, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.jenis-member');

        selects.forEach(select => {
            select.addEventListener('change', function() {
                const userId = this.getAttribute('data-id');
                const memberId = this.value;

                fetch(`/update-member/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id_member: memberId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Jenis member berhasil diperbarui.');
                    } else {
                        alert('Terjadi kesalahan saat memperbarui jenis member.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui jenis member.');
                });
            });
        });
    });
</script>

