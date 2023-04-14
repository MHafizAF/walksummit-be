<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    id</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Tanggal Berangkat</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grup as $item)
            <tr>
                <td class="text-center"> {{ $item->id }}</td>
                <td class="text-center"> {{ $item->tgl_brangkat }}</td>
                <td class="align-middle text-center text-sm">
                    @if ($item->status == 1)
                    <a href="{{ route('grup.status', $item->id) }}" class="badge bg-gradient-success">Sudah
                        Lunas</a>
                    @else
                    <a href="{{ route('grup.status', $item->id) }}" class="badge bg-gradient-danger">Belum
                        Lunas</a>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('grup.detail', $item->id) }}" class="btn bg-gradient-info btn-sm">Detail</a>
                    <form class="d-inline" onsubmit="return confirm('Data akan dihapus permanen, apakah anda yakin?')"
                        action="{{ route('grup.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn bg-gradient-danger btn-sm" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $grup->links() }}