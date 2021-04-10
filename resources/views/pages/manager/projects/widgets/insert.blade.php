<div class="card card-custom card-stretch gutter-b">
    <div class="row justify-content-center">
        <div class="col-xl-9">
            <form class="form" id="form-create-personal" enctype="multipart/form-data"
                  action="{{ $route  }}"
                  method="POST">
            @csrf
            <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Информация о проекте</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Название</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" id="input-name-for-slug" type="text"
                                   value="{{ $project->name ?? old('name') ?? '' }}" name="name"/>
                            @error('name')
                            <span class="form-text text-danger">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Slug</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" id="slug" type="text"
                                   value="{{ $project->slug ?? old('slug') ?? '' }}" name="slug"/>
                            @error('slug')
                            <span class="form-text text-danger">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" form="form-create-personal" class="btn btn-success mr-2">Сохранить изменения</button>
                </div>
                <!--end::Body-->
            </form>
        </div>

    </div>

    @push('scripts')
        <script>
            function url_slug(s, opt)
            {
                s = String(s);
                opt = Object(opt);

                var defaults = {
                    'delimiter': '-',
                    // 'limit': undefined,
                    'lowercase': true,
                    'replacements': {},
                    'transliterate': true,
                };

                // Merge options
                for (var k in defaults) {
                    if (!opt.hasOwnProperty(k)) {
                        opt[k] = defaults[k];
                    }
                }

                var char_map = {
                    // Latin
                    'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                    'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                    'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                    'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                    'ß': 'ss',
                    'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                    'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                    'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                    'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                    'ÿ': 'y',

                    // Latin symbols
                    '©': '(c)',

                    // Greek
                    'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                    'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                    'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                    'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                    'Ϋ': 'Y',
                    'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                    'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                    'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                    'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                    'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                    // Turkish
                    'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                    'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',

                    // Russian
                    'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                    'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                    'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                    'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
                    'Я': 'Ya',
                    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                    'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                    'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts',
                    'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
                    'я': 'ya',

                    // Ukrainian
                    'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                    'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

                    // Czech
                    'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
                    'Ž': 'Z',
                    'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                    'ž': 'z',

                    // Polish
                    'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
                    'Ż': 'Z',
                    'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                    'ż': 'z',

                    // Latvian
                    'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
                    'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
                    'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                    'š': 's', 'ū': 'u', 'ž': 'z',
                };

                // Make custom replacements
                for (var k in opt.replacements) {
                    s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
                }

                // Transliterate characters to ASCII
                if (opt.transliterate) {
                    for (var k in char_map) {
                        s = s.replace(RegExp(k, 'g'), char_map[k]);
                    }
                }

                // Replace non-alphanumeric characters with our delimiter
                var alnum = RegExp('[^a-z0-9]+', 'ig');
                s = s.replace(alnum, opt.delimiter);

                // Remove duplicate delimiters
                s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

                // Truncate slug to max. characters
                s = s.substring(0, opt.limit);

                // Remove delimiter from ends
                s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

                return opt.lowercase ? s.toLowerCase() : s;
            }

            $('#input-name-for-slug').keyup(function(){
                $('#slug').val(url_slug($('#input-name-for-slug').val()));
            })
            $('#slug').change(function(){
                $('#slug').val(url_slug($('#slug').val()));
            })
        </script>
    @endpush
