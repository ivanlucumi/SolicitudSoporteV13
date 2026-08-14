import re
import os

firma_file = r'c:\laragon\www\SolicitudSoporteVer13\resources\views\externo\Formulario\FirmaFuncionario.blade.php'
soporte_file = r'c:\laragon\www\SolicitudSoporteVer13\resources\views\externo\Formulario\formularioSoporte.blade.php'

with open(firma_file, 'r', encoding='utf-8') as f:
    firma_content = f.read()

# Extract CSS
style_match = re.search(r'<style>(.*?)</style>', firma_content, re.DOTALL)
if style_match:
    new_style = '<style>' + style_match.group(1) + '</style>'
else:
    print("CSS not found in FirmaFuncionario")
    exit(1)

# Extract Header
header_match = re.search(r'<!-- Header corporativo moderno -->(.*?)<div class="container-fluid">', firma_content, re.DOTALL)
if header_match:
    new_header = '<!-- Header corporativo moderno -->' + header_match.group(1)
else:
    print("Header not found in FirmaFuncionario")
    exit(1)


with open(soporte_file, 'r', encoding='utf-8') as f:
    soporte_content = f.read()

# 1. Replace CSS
# Remove existing <style type="text/css">...</style> and <style>...</style>
soporte_content = re.sub(r'<style type="text/css">.*?</style>', '', soporte_content, flags=re.DOTALL)
soporte_content = re.sub(r'<style>.*?</style>', new_style, soporte_content, flags=re.DOTALL, count=1)
soporte_content = re.sub(r'<style>.*?</style>', '', soporte_content, flags=re.DOTALL) # remove any extra

# 2. Replace Header and Body
soporte_content = soporte_content.replace('<body style="background: #fff;" >', '<body>')

old_header_regex = r'<div class="row">\s*<!--Logo principal index -->.*?</div>\s*</div>'
soporte_content = re.sub(old_header_regex, new_header, soporte_content, flags=re.DOTALL)

# 3. Replace card with corp-card
soporte_content = soporte_content.replace('<div class="card">', '<div class="corp-card">')

# 4. Fieldsets and legends
sections = [
    r'Informaci&oacute;n del Servicio',
    r'Datos de Usuario',
    r'Despacho:',
    r'Falla Reportada',
    r'Ingeniero Asignado',
    r'Datos Equipo Afectado',
    r'Elementos de Soporte',
    r'Requiere Repuesto',
    r'Descripci&oacute;n del Servicio',
    r'Elementos de Seguridad'
]

# We need to replace:
# <div class="row">\s*<p class=""><h5><center>TEXT</center></h5></p>\s*(<hr>)?\s*</div>
# With:
# </fieldset>\n<fieldset class="corp-fieldset">\n<legend class="corp-section-title">TEXT</legend>

for sec in sections:
    # Build regex to match the exact block
    # It might have a <hr> inside the row or outside. Let's just find the p>h5>center
    pattern = r'<div class="row">\s*<p class=""><h5><center>' + sec + r'</center></h5></p>(?:\s*<hr>)?\s*</div>'
    
    replacement = f'</fieldset>\n<fieldset class="corp-fieldset">\n<legend class="corp-section-title">{sec}</legend>'
    if sec == r'Informaci&oacute;n del Servicio':
        # Don't put a closing fieldset on the first one
        replacement = f'<fieldset class="corp-fieldset">\n<legend class="corp-section-title">{sec}</legend>'
    
    soporte_content = re.sub(pattern, replacement, soporte_content)

# The <hr> might be outside the div in some cases.
# Let's clean up any lingering <hr> right after the legend
soporte_content = re.sub(r'(<legend class="corp-section-title">.*?</legend>)\s*<hr>', r'\1', soporte_content)

# Add closing fieldset at the end before the submit button
soporte_content = soporte_content.replace(
    '<div class="form-group row mb-0">',
    '</fieldset>\n<div class="form-group row mb-0">'
)

with open(soporte_file, 'w', encoding='utf-8') as f:
    f.write(soporte_content)

print("Update complete")
