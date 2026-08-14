@extends('layouts.soporte')
@if( auth()->user()->rol == 1)	
 @section('title', 'Listado de IPS admin')
@else
 @section('title', 'Listado de IPS tecnico')
@endif
<!--ponerle titulo a la paginga-->

@section('cabecera', 'IP Usadas')

@section('content')

<style>
     input.line:focus,
     select.line:focus,
     textarea.line:focus{
       outline:none !important;
       outline-offset: 0;
     }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-2"></div>
        <div class="col-xs-12 col-sm-8">
            <div>
        <table cellspacing="0" cellpadding="0" style=" border-collapse:collapse">
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <div style="width:100%; height:15pt; display:inline-block; overflow:visible">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                                style="height:0pt; display:block; position:absolute; z-index:0"><img
                                    src='data:image/png;base64,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' width="132" height="40" alt="Logo CSJ RGB_01"
                                    style="margin-top:3pt; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:3pt; -aw-wrap-type:none; position:absolute" /></span><span
                                style="font-family:Calibri">&#xa0;</span></p>
                        <table cellspacing="0" cellpadding="0">
                            <tr style="height:15pt">
                                <td style="width:73pt; vertical-align:bottom">
                                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                                            style="font-family:Calibri">&#xa0;</span></p>
                                </td>
                            </tr>
                        </table>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"></p>
                    </div>
                </td>
                <td colspan="2" style="width:253.2pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:middle">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:8pt"><span
                            style="font-family:Berylium">Consejo Superior de la Judicatura</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <div style="width:100%; height:15pt; display:inline-block; overflow:visible">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                                style="height:0pt; display:block; position:absolute; z-index:1"><img
                                    src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI4AAABFCAYAAACc0t5/AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAADi5SURBVHhe7Z13eBTn2e7P/+c65+RLbFMEkhBFgME2NmBMx2BiO4ljx467MW4YG2xAdDC9dwkhCUSzKaYXi6aCCgLRER2E+mp3tb2vVp373M+MRhKO8JWc5LsOcjJcNzM7Ozs7mvc3z3M/75T9H/jP8J/h/2H4twLn/v37dVPqdMPr+6i9X8VxFacqOV2BmtpyRfIaqFWWkqG2thY1NTXKWBsar/ffZfi3jDjS6I0bXkAoC3hRUeXnfIJDlVf4OM+NquoygqHCUllZiUAggOrqauVzD8L37zX824EjAJSXl6OiokKBRyDwer1wue3weJ0KQCKZlnl+v4fLB1BWVqYs53a7lc9rkUdgknXI9L8TRL86cBo3nkxLg2rRRcYCgDS+x+NRpv1+P5xOJ1/LPDff8yjvyTLqtAqL9hmRAKR9Vl77fD5UVTHN1UUg+R7RrxmkXzU4GijSsBJhJDpIo2sAuFyueii83gDn+eF2+Tjfx3mcViSvVZA0aGRaPqt9XuZJFBJ4BCbt+xpD9GsD6VcFjrRLba161Isk2khDNm5gaVSZpwGgygO/rwI+bzm8HgLkLmskiSreBz7b8DlVGlAi7bsEnF/z8KsCp7q6io0racSvmFhpUGlEtVElihAQv0QgaXx5TxMb3MmU5fDBYffCbvPAZtXkht3u4nwXU5pEGYFFoGuQBpZIg9Lvl6gjUaiiTpX/iTiP6lBZGaChtcLtcbBBnYp3kTTj9TJ9MJp43BVMRRWEpJxw+GG1eGExeWA2uWEu9VH+h0jee1AWEz9vpl/iutRoFVC/h1HJ62Uqo7F2e6zw+S002mb4A05GQyntfx3wNHtwJB2pBpjVUkVZHTg2guNQIo7H41NSjstZBpvFx8aWhvew4QUarzJtMgo4TQHTtExGWYeAE+DYC1OpU4lSbpcabdTU5SZE3AafmdtDcMqcqK5RKzlVdX9AMx2aPThailAazEt/URdt1BRFf+P0KSnHYnaxkd0KJEa9UxkLODIuNch7TUPSlEoN8jmJOmUoNXpg0DtQSngsZgdsNoeS0mR7fD5Jg1Y4XYw8PjfTp5pCVTVvD9RswdEqFs2gNkg1p1IhiT8xm5xsXKfSuBokGjgPvvY9IIHDqPco+vl7Mk+DR4VJoo6LsvP77LBY7IxATJNObgc9lBhmNfo1VHQCljY0x4qr2YHTuGKSjrfG0KgN46PJpaG1uQiMnY3soAiIiJBoagyNoUSWUSFpLL3OhZJied9FuR+QvG8iPKUGgYzRR3yPmamPoJpNhFQgMgtAbkYc2S7pQJRUJh5IolEDODL8B5z/5kHKXK2vRBqgMThSIbmcXppeNrTeygaVSKJFDGnkB+HRoNHr7E2CoYEj459LWcbAyKNnBCohPBzLd4hnUsy2FulKnPRWUrURHLdqoGW7xQNJypK/Rw4AiTrNaWh24AQC0vOrdr5J1aQBI3LYBRSbcrSXGh1qIypVkKQTiQx10UbGhMZYB01Jse1BMAQeglPCaQFHUVEj1cFkYBQzlnhh0NXBwwikfp8Kj4meSuaVCmCESEp+6WjUwFF7rD0KQNr5r+YyPPLgaGlJG8rLufN94hlU3+DzESRWMxYzoWGUsTA1mRVABBrON4pYTTEaWNigVkYdC1OPWUdDW8xII+CU2KHj68YqYaQQ6SkjQSltJD3haZCbgHmg4zpFRvE7JjHOAlCAgFZQ5UpEMtMHOR2qv5Ht1yKm9Do3HppD2mo24MgRKZ1o/jJ1p2uVk4vQSGpSvAV9i0XPiKL4GTn6G8CxERwNGgsb30RoNHCUVFVkhbGRShmFNJmKGiSv1WVkzNdF9EfFjD6URCijmGZ6HrN8r0GA0cARM+1StlWqLomakm7lb5DTIvL3NSef0yzAkSNSoouSmqRL3yUde9IAkhLsPMLFjEqVxEpISQ1+GAwslUvL2YCigNKQZqYnMyOIAFNapIJjJDQinc7ygEpKrIr0lLFYVammQku9TASntIjAUIZipi5JW1Sp3k+AuA16iToyVsExldoIj13pmNTOo6mpSz1xqp0sfdSHZuFx5GisB0fxNF4l5FstTCMGHvXSIDTBRh7pBkKiK/Gz0QkPG8xoCLCxKpim2IDFanqSSGFiOjIJRJw2FBACHacfIjG4jWXkPD2jjr6Qn2X0UiKOeCOCo9eJ6Huk2iKsAo9EIDHoiiHn9ooHs1qdCjTyd8nfpPZyuxS/0zg1P6rDIwtO46NOjkJtB3vcDO9MTw47q6VSglDnZ5R+F4GFZlVXyPTBBjTT4NrYeFZGIGlsLcqIBBwFogJGkzwLzGz8BjGVMZJoMvJzBgGM0vMzegKoK1THUqpLimrKXJfW9/PIWOCRFMrtEBntSsoSWFTPo/b3CDj/iTj/xCA7T0pU7VIFgUbdwerJSOkJVhtChUZSg4XpwKFnGjA44NHb4GfjlJU64aX5tRWaYZZIo6UoTku0Eb/jUHyPTKsyMx2ZJA0pqYiGu9BUL3ORBTZGHbNEogIbSgipvthDqAgwoTNxffKepEQTPZVa2amSVKV2CQhU/E6zFQ6HQ/m7tOgj6aoZRRwhvCnK/1nytfU2ITmq6vTzI4xzUM2dFwiU16Um9dIFqaA8ngBsVvExAo6MReIpymCVEvvaTegy0mHMSIEpMxWGtJMwpqfDfOWqAoUSQRhtRKZC+pWcEpiv5cKVfRuuqzfguXIdnss3Yb16BzbOc16+AWf2FU5nw36F48tXUHL5Osy5BtjpjUyMMCUEx8YKy51rgvduCbw5xfDk6+AsKYWNpt0ivcompi/CY2RKFXCkS8BoMMNms8PnlVMR5QpA8rfK2X25XPXhQ90+/If1rxsUcGqqpR9BLtC+j4pqHuXc5orqKlRUleF+TRUX4IymJF3ltTX1qmVj19ZUc31VHNPk1bJS0CSvNUkFUU08akRcR6N11XDZyvusMu4THH813E4v/D5GDa+kqRrYlBOLDUexdPdrcjoqkBW/BQmDeyJlcDAOUIlDnsaRgc8gOWIkfEYLLPlWFDAyFdKP+BlZdIkHsfNPA/HTgB7YP6wjTg4IQXKvLkia8jWOj/0U+3t3xrEhYTgwrAOOvBiMowMew74PXoXrpg6WPJbyOhuKGF38t3OQPu5LHOJ3JQx/FrveHoTzMQsIYDY8JjNKrG7kWstQbC1nilWrPCWdMpU57NKlIP1TAo6LfyfX53GgvMyDWu6HCu4b6eXhXlIG1pkU9+NDxf37ECkANTpgG4tfpkima2Veo2V/PijgVFbUorKSG8cGlIarrWXDs3FrKvllCvnywab04NB4jnxpLT8rGyCq4R/fWOSmQVy+mstUcfkKgYfgyA4r89XATRPs89oYaezcuRVNgNMgh41mOCUd5/4yHKeefxyZL7bF2QGdkDXgSfz0xgDYL16Gm1EplxHqLkt2R4EOVyIX4cRLz+F8v644PaQNrvd7Ahee64BbS2fg3pyJONMzDFf7heLcwE64MCAUWf0ex6H3XoH1tgk6wmfSMX3dycGxaeNwaOgzODuwPc4Paofkwe2x88VuODJpLEwXzsDBtKSz+lBsoUk3+QmOREnVA8nJVoddSnOR2tXg87rYJjxwuXfkH/eK8k+gaWrf/32DtEWAAKq6/zOhbqy9ry5Txo9RfNV4UMCp8ALlvkpWKUUsb6/DTvmseaiwmzjfhECZsUH+OtVP8/06eT0Gzjcz4jgZRVwc2+tVXfWgqvh+VY0blVR5pRMV1P37fm5NufL5mopyfjfBkcs3PRa43GYl+tjqLotoSlYqcK8Q5776BEm92+D0wLY41y8E5/p3QOrLPXFn/Xr4WNHk0RvdMtML6fORNOJNnBrQDRdeaI+sgS1xvu8TODu8F/R7NyB3wWRkPNsSV15oS2A642y/MGT0bYGDH/4J9ntmRg4a9muXkD75axx8qQfODA4jgI8he2ALXOjdgt/bET8S2vS5E1FWVMB9y+qL4As4Ypal0lO6EAiz1eJRjX8dOF6vhweYXL+j3rYjjapKzqo/2Ij/rYMSceqmlQn1hQJOtZ9Hut+B9JRNiIv8CDs3fIp9caNxMHocDsZH4ODmRtoUgQObJuDAxgnYFz8Oextp9/pvsJ/vJfwwBUe3T0XCtikN2v6gDm+fTs3gezNweOtUrncSEjg+tm0Wrp3Zh4DDDI+D4Zv53+mzERwLnBaHAkdT0IjEfAaMVlxetgiJw59jQ4YwArTGuUEhSO/THpfHj0alvhR5JQ7kO6woTD2EU39gSnk+nFGiA84MCmKqaovUT95A4OZZ3J4zCSm9WuLMkJZIHdoepxjBMvv/BoffHISKW4VwXr2Fi5NGI+2FcFwhVNf7t0JW3/+DrEGPEaDWBC4Yab3b4ug7L6E0/STcFi/0rPKMJlZYolIp1el9uD0Clcsl/TkEiGnZzTTlL3Pg3t2zuHHlGAruJKMoLxW6/HToi7JoyM/Vy/A3OlsvS+ll2CzZcFqvwWW7DbdVR5U0LYu+ftpjN6CC+722woPqcpp3Lw94Wpr7Csx14NyvrGCEsOHO9T1YOPUFRM16DnHTn8L6iV2xafqz2DjjuXrFT+uB9dOeQeyUp6nuiJ3aoA3TnkYcxzGTuyFm0pOIm/LUQxUzleuYynVN6YG4iU8j8qtOWDqiDeb8tQXOHFiMMlsu/C6aTqeH4Eg/B6FhtWRWTiU0LekEdFhc0KWl4ejbf0Ra/xCmq8eYglogi1HjLBvQfo47lGnKbjHh7PKpyBjcDdl9mIYGd2KECEFCvw7InDMZ/CLcmjYZaT1b4dTQ3yL5pSBlPRde+J849UY/eI6nInXyVBymNzrTpzPO9ArB6T6tkDk4COlD2yDjxVBc6N8WF55vhROvD0TJsaNwMyXpDX6lf0dOgUiqUs09zXOpA3a79O2wkfxe2N1WHiwluH0lAfFLP8bqaS9j3dzXEL/kbWxYQa18q0Er3nyo1q+kVvylTm9g4+q/PFyr3uL4TWV6U+Sb2BL9DrbFjcC2jV9g/54o2gUzYVFPjyjgBCqYz2q9JCsf6UcWYOXkZxA/owO2TGuFLdPbYfP09o3UgTC1R/zUdtg4rR2nw+q1dWZHbJkhy/D1NJG8r2rzjAZtmhGGDTM6UuF8Lxybp3TC5glc55hgrPuiNaKnDoK75DQ8tlI4vKyWvD5YaS5tJWqfTFPQiCR16M000XozEkd9jpN92yFj2H+xER/DxRdaI+P3XXF3y2b4zOUI3MlF6udvIKVfMC7264gLL3Zi4wch5Q99cWfPDlSz2smdNhNpzzyBczTEpweH4jxT38W+v0XGm4ORt3k7EsZ/g+RvRiJrwpe4EvEpTr01CKlDOuP0oDBGL4IzsA0/2xZH/joMuqQUuPi9OkMFmfTBqXfB3Agc6deRi8CkepRTKk6m5jJPHrKOrcb8T5/Ess9CsWHSU/h+bl9smNUT62c9W6/Y73gQPiAe1HWKmckDleMNc55F/LweiJ3dkerUpGJmh9dNd0DsrPbK9PoF3fDd162QlhiNsoCFmUv8Th04ZTTF3jIhqQKWonPYGTUCm+c8hZ1zg7BxemtGkhCsn64qjtNxU9oiblIbxFLrJrbFukmUMm6D6IltsDYiCFETgjgdrLwWRSnzWlGtqTZYyXmiVRFtuR5CNjkc0V8HY9GIxzD94xBsXzcGHqeO4NALeBjSGdqtRRUsuR9ujuWaGJ2lDA5HAJcXLWU06cJo8RummMdwqW9rJFHn5s1GufT/HD2BtL8MRgphOMOUkslGTqcfSv34NThusuw2GnB36lSkPtcCl/oH4Wz/zjTZHZHRLwgJrKqcN27Ccjsb7oLrsOZcR/ndbFyllzn54jMEMQxX+rbFVUIjEB1652XoUjNYmlegxFDOv8FLf8XoWQ8Ot4fgWK1y9aJ0dDrhdJWgKCcV333eG4s/5gH1ZUvEfxuEDRNCEBvRDjHjGxQbwUauV5jyvqa4iWFYz/27YXIHqhM2MlNsnPJME+qBDVOYXTjexMCxkVlj41RmgvFP4cDa9+GzX6ex9jFdqdcRKeCI4VEqMWW6FtmnfsQPCwdg/4LHsXdeC+ye15YQtcX384KxhdPbZgdh18xW2DGT82aGYcvMUEaaNoo2TW/LL2zLjejAtNUVsQQtdkobpiTCNrUFYidThGXDxFZYO7El1k5qjTjZIaODsfijIHz3SUfM/LYfko6sYsgugIsVlYPgyGWaAo1Vzjk1AY0iQxn0pipYnOW4l7AfKa89j2v9WtGsEoo+QTS6wUgZ9T7Kcy/h9HJ6rMHhNMbBuPR8EO5wfGjokzizejHK6YMsBffoib5E2vM02Uw7aUNZUdErZfVphyTC5SvKha7IDjMrqxKDhSW3HtcXzsCpIeGMTi25bDA9TntCGYoUVmGW5CR46MF0rKaMBNyqdCHI36Ia5VLCLJdiuF0BFhl+FhsG7Nk6B9M/64HZH7TA0o//F9Z+/RiiI1rxICUwEzo8RAIPoZnQtOImhCFufHtFsVw+dkJHfqYj1k0Ix/Jx7XlQ02KM60qFEJogrJz2AnKvHiEXdaV8Y3MssNQKPJyS8rvCnY+s/d/gWGRnJK4KxfHlzP3LQ3FgeTvsXdEO+5aG4cCidji4iOPFfL0wmGqjaM/8IILWBj/ObYcdcztj+5wwbJ8djG1z2uIHArd1Zht8PyNUAS6eWjcxRElPq//6BNZ82AkJ60bBlHsaNWU2VlE0xC4f7E6Gd4JhYUi30Mf8DTCajGXQ6ZkO6B98t28i6b1huDwgBFfYiKcHtkNmn1Ak0efc2roSSWPfwXH6ngsvhuDqkBBc6tUCCX/pj4KEgwjobbDl5+DS+FGKuT0/kMBwHZf7tcWlnh1w8qM34C/MRXEBvVIeo3ShDz6dHbfmzkHmEEa5F1sQoCBcYhmf9QKj2Hsvw5p8Al6jEyXcNoNSUf0MHOkUJFh2m5fVVRmNMreh9DbOJcYwyg/Dik9CKTbkV9xfSmOHNal1hGYt92lTWjcxlOAQHolSCkiNPxeGVcwQayM6Yv2Ezohj9Foxrh0S90xCpb9EYaTxoIAjs2oUdDiWzrtKCwx3tiNl68tIj+mKMzGdcIpKjgnH0bjOOLTuSRyK7IajkeFIXhuGpCg2SFQwTqwJRmJkMI6tCsLRlW3w07JQHFoShoOLg3BwSUvC1h6757THngWh+HFhe0a1DvhhTids+7Yd4t9thc0fP4n8E2tw321CBfN9wFPOtFMBm71S2almNqiFO79JaCibmRFHTnIy/NcYTLg4/Wt6jo44IyZ1KE3vgCCceLkHUj54GWf+/AIu9m/DauoJnGIZnsqoc+D94ai5lwtXkRXW/Dwl4qSzrL/Cz1+ksvuG4GLPcKR8+Ca8BKeogIY2txrmgmp4dX5cm7cE6S8+jYyhLQkPy3iC9veCIydpS2n+5VSKm+CYaJS9PidqvfmwZO9E9OieWPhOGyweEYLV37QnCO1oAQQSSoFFVRThiJwcrCiqbqxNR00KRUyERKWOiGZkiiYcAsy6iFAFqrXMDFGEJ2ZiONfVHd8vfx3G/GRSIXelCikNgwKO0gFHdCTmSOdcVbkT1WXXkXUkAhkbeuLSpqdwLr4Lzv3AnbLtWZw5OAznj7+Fa0dfRdb33ZG2oSNS49ojbX17JK5lORtLkKJbIWVtCFJWd0dyVDsCFoRjy7oja+urSFgZgqPRbXEgMgiHV4YifUkXJPEP+n4EU9joZ3EldSsq3UVwOUqV63UttgCM9AXmEk5zBzcFjchi9rBR2DBGmt8SG/R7v8ehV59G+oB2OD8glBVPC6QN7sjXXelb2uFa38dZ+fwW6UPa4Cgjxen5k1FZZIRLx3Xl5+OKAk5rxeRmDm7D0r4dTvUJx7GRb6DMmMPGNsNW7EURI53cp3V+8RIkD+vBqoplOb/rel96o77Bf3fEUS51ZXUl1xg55BJTnxXOkgs4HPkZln8UhpUfMr2PCsUaRoKY6V2wmsCsYuSIntoJaya2VxQ9pT0iI1RIIhllFEWo4yj6najx4QSjKytf2ogpXZiaBDhCIxFpCv0nrUMU56+c1Bdnk9YxBblQUyUdwUJKw6CAI91Laq+kukB1pdTqdpQWHkH6tj8gdV03XNjaA6c2dsHFvX1RfPFTFFwai6x9ryBrW19c2jMY6ZueRcbmnshJ/COyDwxG5vddkL6+K3ISRuLm4eFIiWNK2Ps2co6OQsYmHv1bWiIlviUy1nN+NJelF9r2SQss/4CGefaf4LKfg9ubB7ePJtLKErYkAEsJ/Qt9TFPQiEq50w2MTEZ9JZzFPlTcvYkf3x2MtGFdcJnR4qx4j4FhnO7E6BHESPI7XBrwBNIHMwW/0huWxEPwFlthl+/KL1LASWM5nUmwUoYFEzBWaX074MSI3wPGiwgQngp9IbwOA6pYBV1dMgcpQ7uximvJSNYSt/q0xdl/JFWVSnVlU0/i2iwo8xkQv3w0Zn8YjlUj6G2+eALxE4IVcJaMCcP8L9tgzSQCMLMHoqc9xVTThSB1xBp6l6iJnRTJdDRBWPxVEMHoRkCe4ee7YfW3nTlNcCZy2UmMVARt7cTWiGVFvGrKk9gZ8wUqvcVMRzXKecOfcdMAjno2pJrL3UdlpVx1J1WWCdfSJuNoTB+ciOqGE5EdkBhHiH76E7KTR2LPqt64nfoZ8rPG4vqJj5EY/yJyMr/EraQPkLV3IMHoA8uF1TCc+wonN3fGnSOjcX3f58jYEsYoFozzW9rj3PpwpM4Jxq6R/4X1H7TG9ulDcfPcDvhdOQzZejicPPqtcjFUOSwEwsJStiloRKUmG40ngdfVwFJcRZNrwNGpnyBxSFfcYqVzqX8rnO/PMRv/7CDpl/kd/UsQU1VnHHz/VVTeuwVTgQ1mHX1Lvg7ZCjgtaY7b4OTQYKXEvvx8KI69GI6kyW9RHyJ99FtIm/QRUmeORvqbLzGCtWe0aYlzXO81QvP3gmOU65eZqowGgkufI+euPPZSHNu2BN990AVLPmqJFZ/9DqvGtsS2Rf1xeu/XuJ25AMe3f8ZSeyAip/TCwjEEZGwXbF0yFPHzZd6ziJ7ek/M6I2nrB1gytisB64vE70fSbryOZd90YCQKR+QkmmKCEy1V2KyuWDmzJ3T3aIhrK1FVQR6q5fblB8/YK+CoZz8Izv0qLsApzlAp8yLgPISdq57HT2t64NCyDthJ85u6fSguJX6CTfN6EJxxyD46GtmJY5Gw/g+4cnwUrhz7FBn7/ojUH16B/dJ66C+yTN3eE8nr34DxwnykMOJcjA3HhZhu+GlWG0aa/43t77XEyfmvw3PrAPylRfBbnXBZxSjWwmypJDhMU/QuFqk+lJ3+t1LAYVlrJjhm3X3Yi0uRc2ATq6euuNabJrlfsHL64Xx/ltUvBuHksMeZfkJYWT2F83MmI1BUiNIiJ6s3gpenU1PV8y0YPaSsDmWJHYzc3qG4NpSgsco6Org9LvSif+pHE8kodrlPF9ztRaM9gKmK673cN0zxOCcJjiU5sb6qEnDMcuvxA+DIxe92yqKc/XfT15Wzmiw353B/rsTyz7tiwcctseBLFhKTn6X6EpyliJ03XEkrWT9Nw7XkeVg7cyC2Rb2Oiye/w9ZVf8aiiJ5Y891AOA27sODbHvh+CTPIjtGIm9EXq1lBrZnUuQ4cmuXJnJ7Kg2LfGNRW5aNWTngz+VTWBFh1S2BpGBRwlGBDYKrAjeW/ipoyVFVz4Wo/rmfMQ9zMTtixsCt2zO+IrbNCcWR9f6Tvfp0hMAz71w7C1SOfYv/q/krfz930b3ErcRS2LeiGs3tew+kdr+HSwbeQvHkQdi7qBt358fQ3PZC8vAOOE8TkZV2xZ/Tj+OGd32H3V8+hMDmSR2YePGarCo5XwJHrdjVwBBJthz8oo1m68r00qmVw6qrZGGWoLCzEvtf64SL9yemBnXCGOqd4HvoWlupnWD7ve6ErSpJPwmYww8BUZSlwwZZbhMvfjsLJno/h3KDWjDYScYIJRCg/y2hJiWG+0jcUF/t2xIW+4ZzuiKvUFcJ5aUAHJT2efP4JpHz1FkrPZ8Fu8jMdVSjbaLQwsin3rMvfIxWVWi3KfWByq7Kc0PWV+eH35LNiS2bR8SGWfxiEhZ+1ZNqhn5nwLM6fmIZlk/tgxdR+uHp8Lg6s/gg7Vr+NHRvfwZG9o7Aj/kMsnTUUh34Yi5wrG7FpxV+Zhp5D0rZPcCj2HSz/tjuiIkQd6XVCsHEaI9DUZ+DQJ6Kqxq5gUSPepTZAPpoCp5bJimW4xJhyuayB4Ny/74a1NBubFjPsfdeFRqodNkwNReykYGyZ0wXfL3yaBq0zNs55hm48nHB1w+b5z2L70j7Mk12xfmZXHF43EHtW9mb19BS2LX4GPyx6GteOM8UtfQaHFgVj/2JWXkvbIWlOOxz4uiWi338cq7/qjlNHV/CoP4uyAI2ql9WUlR5AAYfeQ+k5blrGupOHnhIfHCUs4U019CAWZEZ8xiqHaZGNfYHAXGJ1dalfC2SzDM9k1ZX0x76ouJcPu8VJ+eiPvKyW6HHGfYnUXo8TnCACQ2gIzlmOFWi4HllX1iDVOJ9uJHkt5Xg6lz/A6HZm8QzCbKB5r6IPq1LAKa0HR02zDeDIfVj8GyxsuDKCfC8JP0V+jGhG5PgP/xc2ffMbbJ4Riq3zn8LllC8RM/8ZxMztgayEUcj8cQRiZnbHgU2v4kbmRGxZMQiLI7ri3pl5hOVznEsYh3ljW2P/uuHIOkDD/U0YfY1UV0HU44ifznI/ojPSExbRsjiUaluubGCpzYkmyvH78CseR5iqrmVtRcJqKwpwYFsEVkR0U9z36m9ZptGBb6Kb37GoJ1aNC8WW+b2xbdkgbFs6EGtpzqKmdceWRX2xc+UQ5t2e2L5kAHbyfdEOajuXk3kHIodiF6PXodVPcX0tsXd6GxyIaIvozx7HnE9aY8XcV+F1ZsHtuQu7q5RG0a2Co6f3IDxNQSMyCThMBU4aTRsrHaOxAu4iM4p2bcHuQZ2QxuoojdCkK2qDZEahQwO74u7cyagoNtKgWtVOOD3BUzwOfQs9TtbgECXSnGP6OT9A+nRCkcHp1MFhNNaEj+s9LRrQFqdY4su6T/ZvjUNMYcfHfIaSjHSYdFboS6VboYoHJCOjWU5sNg2OAq/JBK/lHrasHIUF74Zgx6ctcHzcb5E09zHsW9AC2xe0xYnNfbBlaSesm9WWtqEddi/phI3ftcW+qN7YH8n35j+JdYwip3a+jZipXXE8/lUa6CBGmyFI+f7PWD0umOkpFHFTWmL9lN8yMPwW66Z3xLr5rzJlZ5EGuUaKfNC63Jce4kaDAk41o0vNfXnapgQfLlnrxtXTcVgx/TnmvieVE5ZR4zogNqITNk9/iqnmZexaMhCZuz7C3uhXsWXxQObZboic/gxT1RSc2vsJDsb8Gad3f46T2z7iRn7IyNQfh2NeR8bOkTi49jXsX/YiDkUPx+rxodhECDd+EYRF7/4O0czR+rsnmN8L4bTpCY+f4JRzh9IXMJLIeR7tHu6Ge7c1seIyyrUuaqMYCY9L74Hvxk0cHjMCKSNfw8lP/oyTI19HMkvqgx/8Gd+/91fYElPhKzLBQHDkvJGH63DlF+N6xBgFnFNDghlFCA5L+jOELXloJxx7rSf2/bkPEv7UHykv90ey6PcDcGzoC0h8mfvmr3/A7TkzYUk/Bw/L7AKjB0Vy0byhCnZGTeWqQMLSWFamWrlVRx69YrfKlY9GnDoei6ive2HzR0/geASr0GUhOLGKnoqV7r6VXRjVeyJp8wAkbeiNo2s648eF7bBrRQ/aicHYu7oPfooZgn1ruO/XDcP383vg8NoBOLxmII5EvYQ9PMgTVvTDjtnh2PYdveacx7B5FmGiOU7ZPZPmxkRoKlFJg1zDoqnxoIBTRRMs8Uaikjhpu/4Cw9xfsGpSGGKYhmJYtsVO6oIYhrGYCLr2757DZmrrvD4MjT0YXXph7dSnqO7YuWIwflwxBFsX9CMsLzB9DUD8nL4MrQOwY+lQpriBWD/9efwwZyjWfzcAK755Eqs/a4dV77TG2s+fQs6pdYDXCp/ZCafVo1zVZ7XVsEEJilzrq/R3yPkdVQ+AY2TlxbGJ/sjIUC/XvVhKCE+eEbbLl2HPPAPH6Sw4Ms9xfA6l6WdRfPoqPAV2OOWuTqnIDG64CKiLqeoGwUnt1ZJleBDBCVG8UerA9kh8ZwjsP22D7ug+6I4fQcmJROiPU8eSUHDsBAqPnoDtzDlU5hSjTO70pI/JNweUiGNnChVwzJKu5ORmI1k5r7jAzJTG9wiO1WVFpT8Xt48vw8YREnV+h2Pz2iN1bXfc3vcKMrcMQfb+N/n+h7h9+M9IiuyM41HdcTXhfeSmj8alw+/hJouY7CMjceEAK91db+HYukG4su99XN39ITLi/ojs7W8hkdXx3rn0q4tbYt/CIGyf0xF7lg+H4cZuhhonKlgtyUWajQcFnEoFG3mngh6oFKmHFmMl633pTYydKCfKOjHqMIRxHE0jtY6RJ3p8B6yd0AErvw1hGOyCZWPa0mR1wHKOI6VXcnK40oewalwY1R7rJndRXq/4RvoLwhFNR7+SEC5jnl3zRRuseb8VVn8cjvUz/og75xNQLRdv2W2w272w2mmOCYlJx7DOlPUwcCwCDqOFwWqC3maBnkZaV1gGE6OVtdQJBxvGaSIUPPrLeFSXWxmdlM8SzhI3SriMgUe+m+DYc/KQ/S3L8d6tWIGxSqKXudg/FMkDuiB59PuAsQQBG8tqC7/XEYCVsjnKOPbTvzD12DlfHtyk86OI35nP6VJ+l6vEDwfBkbTa+F52SVEyLi60wGEtg93hQHm5BRW2y7h3eD72fhqOH9/7DXaN/i+cXBmOG7sH4vLOF3Fx18u4vPdVXN0zCJe3P4XMjV05bxgu7x6OSxxf2vUSzu99BZd2v6zMT9/Uk+AMx5Uff49zLFjObuyL0+ufITwhSI4MRdKaYCStDsGhJV1w/uBY1PhvoLzSR3Caijicp4LjR+G941j93XBE0lRtJDQbBByWa7FUDI3Uuoj2WE8oYqXrWrqrJ4QyjQUr3dYxXDZ+GnNuRDuCQUA4T+sKlxNzkeODFcl07JQQRE5pyyjF12NbIu6LVlj+QSvMHdkRk0b1xo4t0+H15sHptREcFRKTjqmp/ozyQ8ChfzBY5RpfE0xsgNLSGhgsVSigf5Az53qqlEe0hZDIheRSAhsJmNyRoJP0xojm5vdYb+XgAv3Jqd5yIVhLmuHWLOdD6JNo3id+i2qW/UX8vkJDOdMMv19SKaF2sgKUO0eVC+kZbUys7IoJTrGZEUSBksab4JQqz9bRwJF7seSeLYcCjpsAVrrN0F1Pxta572Lr5zS87z6BYyN/g/TpbZG1tj3ObumMtPiuSInvjgS+Tt/EeVvb4twW+rBN3ajuOBv/pKKLW55WxlnxXZC1PRxpG7n8hg7I2tQF6bFcfksYzsQH4cyGcGStD8O5uDbIiAlDQvRA5F//gb7XRXCU0ltwUQYFnPLAfVQE/Chz3ULCtnFYMoZHPiPLpvFyQkxOgjU6+8r5sZSM5UyscoKMplnG0fQr0fQrorWcF8VUp2kNIdIUSbAilWkuQxBXj2mDqDHBWDM6GMu+CMHUkd1xJjEaAV8BnG4L7G42tEUMsk0pV9UjVdXP+3IUiek0sRpjhJEqy8R5Usloql+m7oRpKaNPidXJcp4RSF+NgK4CrgtXkTl2BE71aaOeo6L5vchKLKtPJ5yfMB5lZrsCmqxPOvMelFziIVI9mEkkaZNj9ey+Jm6PAphUjWUoLLCgRGeGPFPHbzfQq0xG5EfPYsu7j+Onr/4LaQvbMh2FIiGS1eia1kiIaosj0SFMPyE4HhOKREKQEheGtDgWAuvDCQchkek4TiuvOyFjQyhOxYfi9MYwZMa3Y4Sib9sUhqzN7ZG5oTPObmDFuOl3OL+5BZLiuiPz8DjYzReVSypqaiogTxWrB6eqkjuLpd/p1I2Y9W0frJvdD/GzemE9fcu6qU8jepp0aataN+0Zjus0nfOm8/06raM5jp72NKKmdFdM9dqJXesVRX/UoC5UuDJeS0UzukWO7YgFH7XA4pEhSPxhBiqdtxDwlKDM74HDzRTAktxkIDQKOA2+QKtK/ikRAIlAkubMNK82RgPj1QtInvAekgSWQfQ2w1hJDWmNjBd4FI+fgnI2uEUfgJ0GvMl1KhJIG4Pyc2ngyC3CjEyFPDAMcmG+Gz63Ds6iTMRHDMGWz9ri0KTWOLokBPuYUvYvb4PDS4OQsJzgrAimQnB0ZSiO0TQfXxWKEyuZbjhOXk2YOC1pKInTyUxBJyNbI5VKiwpC2lpGlmhWguuCcSo2FKnr2jPStEFW7OM4v4G+Lv5p7KeRvnVuFWppYeSnCtTnGNaBEwjQEDoL8dPBNdgU8zV2bfkaezd/hT0bPse+TV9iH6c17d08ul6N54v2bBqN3Ru/xK4No7A77jPsi/2kkUY+qLiPsD/2IxwQrf0A25a8gZhpw7Bh1qsw5aQj4CyGx2GiOZbbRViJ2OhV5FyOcifkvxYciQ4uehwHG89gKkeJ3YWim2eQNOEtpD7/O5xlKX7ypWCkvcid3q8rsghOJc26vaScVdvDLyz7e8GRO1BLDWUoKZZq0AG3l9vi1cPHDHAjPQYLP2qP5SNb0mfSCszvii2zO7MS6oof5zyJXfO6qeO53bB73lMcd8XO2e05bs/XHbF3QTj2L+qCA4u74tDiJ5GwtDOOLO+MYyu7KuOEZeE4uqIzweuK/au5zBqW7RwnruyOE2t6MaINwN51L0FflMbKO8CU1ejS0YpAGev0AKqrbExjFMwsy42cr4Pfk0v679XL62qQz833XA2SXk6X7Q6P3GswFF/kl52tl67wDHQFmk5T6ShRlIHi3DTlarf8W0nIuXocVkMuAm6aQ3nClsPL7wrAwbxvkajDBmlcwjbdYP+Y5AJ4KdvteulEZAQhOKarWcgY9RauPN0Gd3uF4sKAVgTocaT374AzU8bDZ2XlVkrz/rN1PahfBkdOMyhdCvRKJUX0YEVy+Sg9ltcLR7kXLp8FudfTcfT7xTi0YSIOb/gWR76fhGPbp+DEjilIFO2ciqQ6Jf84DSm7JuPk3glIFe2LQPrByUjZM57LjeX7Y5Gxdxwy9o3DqX3jcWr/eGQemKDqYATSjkbg1NHJyPppBs4emIFTeyZyfaNwZOcIXDq/GxWVHqYqudOiDhzxxdLRow51N2L9k4NS2f+i5Aogkbz620E6nCr9AQLkIZQSEXmEuwQeaYymGumfk1wgJqZW0pXLTJguXUbyyBHI7P4krvToivQXgpHcvwUSBnZA8qxx8ASsKKIPMZlsTa5P1S+DI/edy9hkCKAg165EHCf/TnkkXTn//nKWweW+AGrl+TkEqdprR6WozIaKcmu9KhurwsQGNtTL7y+C280iw3mP+5AHPAOB15P3N/JwvsuXA48vDz5PMXxOHYPAXTgsF2G3ZMJmv6uAo578rgNHrsNR7+ZrooFl3kMkyz9M8r52R1BTEo+uTctJVulfEsnnJItW1chOcxMcG72OnX8Yy2mvnClvqoH+OZlojvXKM3bUisfBqGPL07Ey2YzMqVNxcep0nJ7No3PuF8iYORZnf9iMUrcTegdTijz3r4l1qvplcOTiLenp1hd7UZDnUB7G5HarD/auLKcJ5b4QKfuTO0l6/pVeXJn3wD9lMUVyOV7V/ep6VdKTaIdopdxoyfcfLqmt1Uv61BsppZUq+crHabmhoVw5hymDAk4taHqkD6e+SbVmVW8bfbh+fuvpg1JOjD1Mcu5DREAUVXOakluDxbcHairh9zlQ5i5Fhc8Kr8+u3CZjtf08PUnjaCJYUuXUVU5WVknag6xVMaIQEpkv0pZRwLHLY1N8cMq9TmxUuWXXZJEHDuTDklsCk64QjsLrKLt9E/ZCEwqkxC7kZ4qZavh5gc6irF/Wq47lOcgWc7kylnkqMGKmRepykqqK8h0ozOPfZ6/g0S4P8najKuDk/gkQkkpUc39VkZxKuQOWe1a5u1Yo0lTNfa2Jr+USCE213I9yW7ZyG7ZQ1/jI/5nuy527VepdvLXK8mwPzq9lm8gt3UpVVd0o4rAl/z/oZ0NdqFIiH19WcePl5nu/X35gQx42IA+c9ikpy2J213WYCTh1jUGfYGa0yLmtR2GuGTZLOXLuWnHntgPZ2UZcvFiE7MsFuHOrENev6NlYLjZoOXLvWKArtuHGHSOu3ihG9vV7uJdnwJ07pbh9w4jcu2YYuN67eaUwmG0E16aMi/Ru5Nyz425OKfQmJwpLbLh9twTX+BmDsRL5hOrWXSdu3HXhVk4JjHLfupTvNOCl+grlwU8mQwW9DaNNrlXp0/HK09+VJ6c6mYLKyIFUMWzsf+GgZpa/Ff+rW+KXhoZl6sB59IbGf5Q8M0Z9WoVcbqD+3oL2mJP6I9kYgNt5H7NmrsLSRZtYvgMffjgDG+KT8dzz7+D9j2Zg2oyViN+8H0OGfIFvvl2BW4Tq7b/ORFLKNfz+D+Mw8os5mDRzJWI2/ITPPl2Ct9+aiQ/f/w4nT97Cm29/jSOJWTAwpelZ+WSdv4t33p2IZSt/gMVWifRTNzFpymp8+vls7Nx1EtEx+/DZqPl4+4NZWLA4Dlev3oJNopvyhK4K6OUkLMvwonwnigps/Jv89BplKOffWlWtPolUHneiNOojODyS4GgPjG4SHOXBSmUKPMpz/5QUpUYdlwPYvecUAYnB8aTbGP7KN0g/o0efAZ8j41wxrjKqpJ69jc+/XoM//WUS9h2+ilf+OAcJJ/LQf/hYnL9lweUcE5JO5WDEZwuReDIP4yetxcxZ6zFs+EgkpmRDz+8y0AMlHD2PPn3ewfSZ6xUAJ3G5iIlR2L4jDfGbjiK3wI01aw8TnIUo0pWzYrKhtIR+qkROn5QrtwLLw5nyGLEk1Xnkij/+bZWMMsw5D/z9j+LwyEYcbRCItF9kEXjkhjV5CLZEHvn9BLm4W7kDQjrkzNW4nePDmHGrMXl6LOYs2I4TacV4rt8XmLlwB+J++AmHki9i4owfMGPuDixYfhjPPj8BR5KK0aP/BEyY/SOiNp/A0dR8/OXdxfhybByj0CocPpKNF4eORErqDZSaq1BQ4MHy5Xswd95WzJu3DQcPXsLx43cxZswKjJ+wAsdOZMPlATZtTcEHI5aARSFhoZ/RUyVypp+RRudAXi5TJv2SPMZW/W0sSctiQsVfNgyPIjzNAhx5iLQ8QFIAUn/FTm4hEYjEmMpj8B2MOG7Fi9gYdeYt2Iyefd7C3oPncT7bjt79RyrjazlmHDyeidHfRCLtTBHGTIhCh/D3cTylCP2GjUPGZSMu3THjZNY9vD9yHlZEHmTEuqes85VXP0d6xj2wbZF91YiPR87GpMnRePPNSVi58hAOH76C5JR7iIrah0FD3oHTfZ8p7yjefm8enC4onZdWOYfFNKWjr7mbayA0etiUZwEGKPXg0H4w7VEfHnlwZJAjTgCqrq6Bzy/AaD/0IU9Slx/5oNdh2pLHozns5ThwIIX+YwwuXi7CxSvFGPLSSB75M+hBlmNtzDbMnh2PK9lFOHD4NHr2eg8nkm7i2V6f4s13Z+DT0XMxbWYMxjFqncrIoW9io5tr6XHGYvjLH+ONN7/C6K8X4LXXv1YAWrFyG2bMXIsJE1fgr+9MwHsfTODn18BoCWBl5I/49MtFcHruw2yxw8aUZKgrvfMKzcpj3ORA0J6uLsA8yr6m8dAswNEG2aFSZbnkIUsKOG6+DtRVWg6mAAtTFiueAgPyWQXJY9NMLMOvXC2hOS3ErRs65OYYoC9S7yrIzzPhzk0jI4CD71tx/kI+LmXnIi/fjPx8O80rP29gpLCW4fpNPS5nF+MSQbx6rQR36IVMrNxy863Ivsb15lmRmHwJmWfuMA156YNYVeVYcP2unVUYDbXByHXZWMUZce+uiYaaFWOZ/CCaW/mdLfUuAtXTyEHyqA/NAhzZkdpDsuX5MdqTOrVn5smv1skTPOWmfeVxsIw80mejmuYArKZKvhaVsyQuo1i61/WlqH0s6ljp37H4OJZ+mLq+IeUsuvTxyHuynNo3pD453csUJOebVHMuY/U7tMtby+ltKqE8vrbESU9Tgtx7RdxOO32PCr72pNHmNjSzVFVdH9LF79jt0qMsqUttAPn5Q3lyuVaqywlE5RJTeh+TciOfNObDJKA07lj8+6TeuttwfZB2SatyDorQmllBFeY7lEhXmC8XrNuUqOljpJEnjMrfIT8y2xzSU+Oh2aQqAUeDR5uWI7Wh2lJ/dkhKdfE88tgQ5Uw6U5Jye61caNUkMJr+NeDIr87UT1PyzOX8e6VMnyZCLcZettfFv0Pux360S+5fGpqVx5FBUpZAI2M5YgUaLW2pEPmYtjws1eVxsPQpevE+cmmm2qBqJJDzRA2RQZ33y+BoZ+PlUg5tWqR1QMr65aeINHh0RU7k55qRd8/A1zYCLb8LKv1Rsp1ysvDRr5x+aWh24Ag0WuqSiKOpoVRXvYN0psmPjMmvysittXJpphoJ5BYUOWUhkmlVTcHSWBo0cqrjQcl1QfK+CqWc8ZYLsu7dNdLP6OmBrEqfU1lZOaWCI9taI+eYmvHQ7MDRwrqMJW1pptnvk98XJzSNfpNTjnDpXBPfI2lLrneRhlWuumNjq798p6opWBqrMThybbAm5dZdfl7WXZhvQc4dPaNMqTLPwcpJoovXJw+C9KGa3kzzaQJ+cx6aLTjaoMEjPa4uF6GpB0cqL59y/kceVCRPurJZ5RoYJwpYqhcVWBiFJBKpUgGpq6SakOplBBz5vYaGz8l6JB3l5ugVA2wgWDZWX25nJTz8Tpf8GrHyzGKt5G6oEpvz0OzA+fmgNYBUJnIuS9KWdKhp/kftYZYSXjXPyi8DuxhtDISnSAedTo8SnRElxXIhlZMwSPoR/9Lgf2SeXGQly0hkKcgT72JiOmKlVGBU1qHXG5XLXGX9bq6/orwSZf6Ash1yll+2qTma4IcNvxpwJPJImd44lWnVlphmgUok00oaq5uWkt5strAKIxg6G0EoRX6egXA0Ur7xAcn5JaPezsgiv7UpJ14FSvUHPKRbQKY1L6bp1zY0e3AagyKNpaUBea0BI0e71vejVWEaOBpc6g+MSDTywsHIYbM66uVwyKWrcnpDfjOLn+dyIo9EL0YzWY98h0hb98/T0a/B1zQefjXgaIMGj8wXWKTBZFokDSugaNFBGligETkc8qt16o+NaSdSZaxKPqOO5QHW5RVSxQl46nKSHmX9Aop8t3ynti3a9jWe/jUMzR6cf2SQxpNGFmi0CNCQXgQAP022ACGPx3cQDokkAc6TaCRn5GWehwDUEEopr6W0lmf/qqA0jjC/7gH4v/6FY6KNF2vGAAAAAElFTkSuQmCC' width="142" height="69" alt=""
                                    style="margin-left:80.25pt; -aw-left-pos:80.25pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:none; position:absolute" /></span><span
                                style="font-family:Calibri">&#xa0;</span></p>
                        <table cellspacing="0" cellpadding="0">
                            <tr style="height:15pt">
                                <td style="width:196pt; vertical-align:bottom">
                                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                                            style="font-family:Calibri">&#xa0;</span></p>
                                </td>
                            </tr>
                        </table>
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"></p>
                    </div>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td colspan="2" style="width:253.2pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:middle">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:8pt"><span
                            style="font-family:Berylium">Dirección Ejecutiva Seccional de Administración Judicial</span>
                    </p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Veneplast</span><span style="font-family:Calibri"> </span><span
                            style="font-family:Calibri">Ltda</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td colspan="2" style="width:253.2pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:middle">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:8pt"><span
                            style="font-family:Berylium">Cali – Valle del Cauca</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:8pt"><span
                            style="font-family:Berylium">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:21pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">ACTA DE INSTALACION </span></p>
                </td>
            </tr>
            <tr style="height:21pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">CONTRATO DE COMODATO DE IMPRESORAS 001 DE 2023</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td
                    style="width:93pt; border-style:solid; border-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:center">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Fecha
                            Instalacion:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><input id="fecha_instalacion" class="form-control @error('fecha_instalacion') is-invalid @enderror" placeholder="Ingrese N. C&eacute;dula" min="1" autocomplete="off" type="date" name="fecha_instalacion" value="{{ old('fecha_instalacion', $soporte->fecha_instalacion) }}">
@error('fecha_instalacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                               </p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:21pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">DATOS DEL DESPACHO</span></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td
                    style="width:73pt; border-style:solid; border-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:center">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Seccional:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:center">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">
                        <input id="seccional" class="form-control border-0 outline: none @error('seccional') is-invalid @enderror" placeholder="Seccional" min="1" autocomplete="off" type="text" name="seccional" value="{{ old('seccional', $soporte->seccional) }}">
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </span></p>
                </td>
                <td
                    style="width:63.85pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Nombre Magistrado o Juez:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">
                            <input id="nombre_contacto" class="form-control @error('nombre_contacto') is-invalid @enderror" placeholder="Magistrado o Juez" min="1" autocomplete="off" type="text" name="nombre_contacto" value="{{ old('nombre_contacto', $soporte->nombre_contacto) }}">
@error('nombre_contacto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                            </span></p>
                </td>
            </tr>
            <tr style="height:27.75pt">
                <td
                    style="width:73pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Numero de Cedula:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="font-family:Calibri">76321772</span></p>
                </td>
                <td
                    style="width:63.85pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Ciudad:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">Cali</span></p>
                </td>
            </tr>
            <tr style="height:20.25pt">
                <td
                    style="width:73pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Direccion:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">Carrera 10 </span><span
                            style="font-family:Calibri; color:#c45911">Nro</span><span
                            style="font-family:Calibri; color:#c45911"> 12-15 Piso 17</span></p>
                </td>
                <td
                    style="width:63.85pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Telefono:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">8986868 ext 1502</span></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td
                    style="width:73pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Correo </span><span
                            style="font-family:Calibri">electronico</span><span style="font-family:Calibri">:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><a
                            href="mailto:mfernandp@cendoj.ramajudicial.gov.co" style="text-decoration:none"><span
                                style="font-family:Calibri; text-decoration:underline; color:#c45911">mfernandp@cendoj.ramajudicial.gov.co</span></a>
                    </p>
                </td>
                <td
                    style="width:63.85pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Despacho o Dependencia:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">D.S.A.J. DIVISION INFORMATICA DE CALI</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:24.75pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">DATOS DEL EQUIPO</span></p>
                </td>
            </tr>
            <tr style="height:24pt">
                <td
                    style="width:73pt; border-style:solid; border-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Placa
                            Equipo:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">27-00000027</span></p>
                </td>
                <td
                    style="width:63.85pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Serial:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">KVC67086TDBAS</span></p>
                </td>
            </tr>
            <tr style="height:24pt">
                <td
                    style="width:73pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Marca:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">LEXMARK</span></p>
                </td>
                <td
                    style="width:63.85pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Modelo:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">MX521</span></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td
                    style="width:73pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Tipo
                            Instalacion:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">RED</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:21pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">DESCRIPCIÓN DEL SERVICIO</span></p>
                </td>
            </tr>
            <tr style="height:39.75pt">
                <td colspan="4"
                    style="width:524.6pt; border-style:solid; border-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Se
                            realiza la Instalacion en el Despacho, conforme la distribución del modelo realizada por el
                            Supervisor del Contrato.</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:73pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:182.35pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
                <td style="width:184.4pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt"><span
                            style="font-family:'Times New Roman">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:21pt">
                <td colspan="4" style="width:524.6pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt"><span
                            style="font-family:Calibri">OBSERVACIONES</span></p>
                </td>
            </tr>
            <tr style="height:22.5pt">
                <td colspan="4" rowspan="4"
                    style="width:524.6pt; border-style:solid; border-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">Se realiza instalación de la impresora, se
                            configura en 7 equipos, se brinda capacitación y configura carpeta para el servicio de
                            scanner.</span><span style="font-family:Calibri; color:#c45911">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:22.5pt">
                <td style="width:0pt; height:22.5pt"></td>
            </tr>
            <tr style="height:22.5pt">
                <td style="width:0pt; height:22.5pt"></td>
            </tr>
            <tr style="height:22.5pt">
                <td style="width:0pt; height:22.5pt"></td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:73pt; border-left-style:solid; border-left-width:0.75pt; padding-right:3.5pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Entrega:</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Recibe:</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:73pt; border-left-style:solid; border-left-width:0.75pt; padding-right:3.5pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:73pt; border-left-style:solid; border-left-width:0.75pt; padding-right:3.5pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:73pt; border-left-style:solid; border-left-width:0.75pt; padding-right:3.5pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Veneplast</span><span style="font-family:Calibri"> Ltda </span>
                    </p>
                </td>
                <td
                    style="width:182.35pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">y</span><span style="font-family:Calibri">&#xa0;</span></p>
                </td>
                <td style="width:63.85pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Firma
                            Despacho</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td colspan="2"
                    style="width:262.35pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.12pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span style="font-family:Calibri">Grupo
                            Mantenimiento y Soporte Tecnologico</span><span style="font-family:Calibri"> DISAJ
                            CALI.</span></p>
                </td>
                <td
                    style="width:63.85pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.5pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri">Cedula</span></p>
                </td>
                <td
                    style="width:184.4pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:3.12pt; padding-left:3.5pt; vertical-align:bottom">
                    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:Calibri; color:#c45911">76321772</span></p>
                </td>
            </tr>
        </table>
        <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt"><span
                style="font-family:Calibri">&#xa0;</span></p>
    </div>
        </div>
        <div class="col-xs-12 col-sm-2"></div>
        
    </div>
</div>
    
  
@endsection