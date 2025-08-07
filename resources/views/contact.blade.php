@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative w-full min-h-[400px] flex items-center justify-center overflow-hidden" style="background: linear-gradient(120deg, #002347 0%, #0a3d62 100%);">
    <!-- Background image overlay -->
    <img src="{{ asset('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 pointer-events-none z-0">
    
    <div class="relative z-20 text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            Contactez<br>
            <span class="text-cyan-400">Elmoumen Academy</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8">
            Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question ou demande.
        </p>
    </div>
</div>

<!-- Contact Information Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Informations de Contact</h2>
            <p class="text-gray-600 text-lg">Plusieurs façons de nous joindre</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Phone -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Téléphone</h3>
                <p class="text-gray-600 mb-4">Appelez-nous directement</p>
                <a href="tel:+212771284243" class="text-green-600 font-semibold text-lg hover:text-green-700 transition">
                    +212 771 284 243
                </a>
            </div>
            
            <!-- Email -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Email</h3>
                <p class="text-gray-600 mb-4">Envoyez-nous un message</p>
                <a href="mailto:centreelmoumen@gmail.com " class="text-blue-600 font-semibold text-lg hover:text-blue-700 transition">
                    centreelmoumen@gmail.com 
                </a>
            </div>
            
            <!-- WhatsApp -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">WhatsApp</h3>
                <p class="text-gray-600 mb-4">Message instantané</p>
                <a href="https://wa.me/212771284243" target="_blank" class="text-green-600 font-semibold text-lg hover:text-green-700 transition">
                    +212 771 284 243
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Envoyez-nous un Message</h2>
                    <p class="text-gray-600">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <form method="POST" action="{{ route('messages.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom Complet *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de Téléphone *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">+212</span>
                            </div>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition"
                                   placeholder="600112233"
                                   pattern="[0-9]{9}" 
                                   title="Veuillez entrer un numéro de téléphone valide (9 chiffres)">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Exemple: 600112233 (sans le +212)</p>
                    </div>
                    

                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Sujet *</label>
                        <select id="subject" name="subject" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition">
                            <option value="">Sélectionnez un sujet</option>
                            <option value="inscription">Inscription aux cours</option>
                            <option value="information">Demande d'information</option>
                            <option value="support">Support technique</option>
                            <option value="partnership">Partenariat</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition resize-none"
                                  placeholder="Décrivez votre demande en détail..."></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white py-4 rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                        Envoyer le Message
                    </button>
                </form>
            </div>
            
            <!-- Map & Address -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Localisation</h2>
                    <p class="text-gray-600">Venez nous rendre visite à notre centre d'Elmoumen.</p>
                </div>
                
                <!-- Map -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.1277641196476!2d-6.765718982304768!3d34.066770846356235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76902afb2fff9%3A0xd4a7ae12def833da!2scentre%20el%20moumen!5e1!3m2!1sar!2sma!4v1754102221617!5m2!1sar!2sma" 
                            class="w-full h-80" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <!-- Address Details -->
                <div class="bg-gray-50 rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Adresse</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-cyan-400 rounded-full flex items-center justify-center mr-4 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Centre Elmoumen</p>
                                <p class="text-gray-600">54 Rue Ikhlas, Secteur Nahda</p>
                                <p class="text-gray-600">Laayayda, Salé, Maroc</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-cyan-400 rounded-full flex items-center justify-center mr-4 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Horaires d'Ouverture</p>
                                <p class="text-gray-600">Lundi - Vendredi: 9h00 - 22h00</p>
                                <p class="text-gray-600">Samedi: 9h00 - 18h00</p>
                                <p class="text-gray-600">Dimanche: Fermé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Questions Fréquentes</h2>
            <p class="text-gray-600 text-lg">Trouvez rapidement des réponses à vos questions</p>
        </div>
        
        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(1)">
                    <span class="font-medium text-gray-900">Comment puis-je m'inscrire aux cours ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-1" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Vous pouvez vous inscrire directement sur notre site web en créant un compte, ou nous contacter par téléphone ou WhatsApp pour un accompagnement personnalisé.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(2)">
                    <span class="font-medium text-gray-900">Quels sont les moyens de paiement acceptés ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-2" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Nous acceptons les paiements en espèces, par virement bancaire, et via les services de paiement mobile comme PayPal et les portefeuilles électroniques locaux.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(3)">
                    <span class="font-medium text-gray-900">Y a-t-il des cours gratuits disponibles ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-3" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Oui, nous proposons des cours d'essai gratuits et certaines ressources éducatives gratuites. Contactez-nous pour plus d'informations sur nos offres gratuites.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleContactFAQ(id) {
    const content = document.getElementById(`faq-content-contact-${id}`);
    const icon = document.getElementById(`faq-icon-${id}`);
    
    // Close all other FAQ items
    document.querySelectorAll('[id^="faq-content-contact-"]').forEach(item => {
        if (item.id !== `faq-content-contact-${id}`) {
            item.classList.add('hidden');
            const otherIcon = document.getElementById(`faq-icon-${item.id.split('-').pop()}`);
            if (otherIcon) {
                otherIcon.style.transform = 'rotate(0deg)';
            }
        }
    });
    
    // Toggle current item
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>

@endsection
