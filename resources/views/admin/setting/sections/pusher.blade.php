<div class="tab-pane show active" id="pusher_settings" role="tabpanel" aria-labelledby="v-profile-tab">
    <div class="card">
        <div class="card-header">Pusher Settings</div>
        <div class="card-body">
            <form action="{{ route('settings_pusher_update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">APP ID</label>
                    <input type="text" value="{{ config('PusherSettings.app_id') }}" name="app_id" id=""
                        placeholder="APP ID" class="form-control  @error('app_id') is-invalid @enderror">
                </div>
                @error('app_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="form-group">
                    <label for="">KEY</label>
                    <input type="text" value="{{ config('PusherSettings.key') }}" name="key" id=""
                        placeholder="KEY" class="form-control  @error('key') is-invalid @enderror">
                </div>
                @error('key')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="form-group">
                    <label for="">SECRET</label>
                    <input type="text" value="{{ config('PusherSettings.secret') }}" name="secret" id=""
                        placeholder="SECRET" class="form-control  @error('secret') is-invalid @enderror">
                </div>
                @error('secret')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="">CLUSTER</label>
                    <input type="text" value="{{ config('PusherSettings.cluster') }}" name="cluster" id=""
                        placeholder="ClUSTER" class="form-control  @error('cluster') is-invalid @enderror">
                </div>
                @error('cluster')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <button type="submit" class="btn btn-primary me-2">Submit</button>

            </form>
        </div>
    </div>

</div>

