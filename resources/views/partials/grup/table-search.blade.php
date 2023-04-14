<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    id</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    action
                </th>
            </tr>
        </thead>
        @if (isset($grup))
        <tbody>
            <tr>
                <td class="text-center"> {{ $grup->id }}</td>
                <td class="align-middle text-center text-sm">
                    @if ($grup->status == 1)
                    <a href="{{ route('grup.status', $grup->id) }}" class="badge bg-gradient-success">Sudah
                        Lunas</a>
                    @else
                    <a href="{{ route('grup.status', $grup->id) }}" class="badge bg-gradient-danger">Belum
                        Lunas</a>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('grup.detail', $grup->id) }}" class="btn bg-gradient-info btn-sm">Detail</a>
                    <form class="d-inline" onsubmit="return confirm('Data akan dihapus permanen, apakah anda yakin?')"
                        action="{{ route('grup.destroy', $grup->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn bg-gradient-danger btn-sm" value="Delete">
                    </form>
                </td>
            </tr>
            @else
            <td colspan="3" class="text-center">Grup tidak ditemukan</td>
            @endif
        </tbody>
    </table>
</div>