				<div class="form-group">
					<label for="Cedula" class="fa fa-asterisk">Cedula :</label>
					<input class="form-control @error('cedula') is-invalid @enderror" placeholder="Ingresa Cedula" autocomplete="off" type="text" name="cedula" id="cedula" value="{{ old('cedula', $user->cedula ?? '') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Nombre" class="fa fa-asterisk">Nombre :</label>
					<input class="form-control @error('name') is-invalid @enderror" placeholder="Ingresa Nombre" autocomplete="off" type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}">
@error('name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Apellido">Apellido :</label>
					<input class="form-control @error('lastname') is-invalid @enderror" placeholder="Ingresa Apellido" autocomplete="off" type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname ?? '') }}">
@error('lastname')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Email" class="fa fa-asterisk">Email :</label>
					<input class="form-control @error('email') is-invalid @enderror" placeholder="Ingresa email" required="required" autocomplete="off" type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}">
@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Password">Password :</label><br>
					<input class="form-control @error('password') is-invalid @enderror" placeholder="Ingresa Contraseña (dejar en blanco para no cambiar)" type="password" name="password" id="password">
@error('password')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				<div class="form-group">
					<label for="Rol" class="fa fa-asterisk">Seleccione Rol:</label><br>
					<select class="form-control @error('rol') is-invalid @enderror" name="rol" id="rol">
    <option value="">Seleccione Rol</option>
    @foreach($roles as $key => $value)
        <option value="{{ $key }}" @selected(old('rol', $user->rol ?? '') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('rol')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror	
				</div>
				