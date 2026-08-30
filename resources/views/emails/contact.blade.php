<x-mail::message>
# New Contact Message

**Name:** {{ $data['first_name'] }} {{ $data['last_name'] }}
**Email:** {{ $data['email'] }}

---

{{ $data['message'] }}

<x-mail::button :url="'mailto:' . $data['email']">
Reply
</x-mail::button>

{{ setting('site_name', 'Taramide Cosmetics') }}
</x-mail::message>
