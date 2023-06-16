<h4>REQUEST FOR BECOMING SUPERVISEE</h4>
<hr>
<p>Dear {{ $data['name'] }},</p>
<p>My name is {{ Auth::user()->name }} (Matric ID: {{ Auth::user()->matric }}). May I know if I can become supervisee under Dr.</p> 

<p>Here I include my email and contact number for your response:</p>

<p>Email: {{ Auth::user()->email }}</p>
<p>Contact Number: {{ Auth::user()->numPhone }}</p>

 <p>Your consideration is highly appreciated.</p>

<p>Thank you very much</p>

<p>Yours sincerely,</p>

<p>({{ Auth::user()->name }})</p>
<p>Student Faculty of Computing</p>
<p>Universiti Malaysia Pahang</p>
