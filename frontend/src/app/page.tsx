import React from 'react';
import Navbar from '@/components/layout/Navbar';
import { ArrowRight, Shield, Zap, Globe } from 'lucide-react';

export default function LandingPage() {
  return (
    <div className="min-h-screen bg-[#050505] text-white overflow-hidden">
      <Navbar />

      {/* Hero Section */}
      <section className="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-4">
        <div className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-red-600/10 blur-[120px] rounded-full" />

        <div className="max-w-7xl mx-auto text-center relative z-10">
          <h1 className="text-5xl lg:text-8xl font-black tracking-tight mb-8 bg-gradient-to-b from-white to-gray-500 bg-clip-text text-transparent">
            UNIFIED RENTAL <br /> INFRASTRUCTURE
          </h1>
          <p className="text-gray-400 text-lg lg:text-xl max-w-2xl mx-auto mb-12">
            The next generation AI-powered ecosystem for property and vehicle rentals.
            Enterprise-grade scalability for modern marketplaces.
          </p>

          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button className="px-8 py-4 bg-white text-black font-bold rounded-full flex items-center gap-2 hover:bg-gray-200 transition group">
              Get Started <ArrowRight className="group-hover:translate-x-1 transition" />
            </button>
            <button className="px-8 py-4 bg-white/5 border border-white/10 text-white font-bold rounded-full hover:bg-white/10 transition">
              Explore Listings
            </button>
          </div>
        </div>
      </section>

      {/* Features Grid */}
      <section className="py-20 px-4 bg-black/40">
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
          <FeatureCard
            icon={<Shield className="text-red-500" />}
            title="Enterprise Security"
            description="Bank-grade encryption and decentralized identity for all users and vendors."
          />
          <FeatureCard
            icon={<Zap className="text-red-500" />}
            title="Real-time Tracking"
            description="Live GPS monitoring for vehicles and instant status updates for properties."
          />
          <FeatureCard
            icon={<Globe className="text-red-500" />}
            title="Unified Ecosystem"
            description="Manage flats, villas, cars, and bikes from a single powerful dashboard."
          />
        </div>
      </section>
    </div>
  );
}

function FeatureCard({ icon, title, description }: { icon: React.ReactNode, title: string, description: string }) {
  return (
    <div className="p-8 rounded-3xl bg-white/5 border border-white/10 hover:border-white/20 transition group">
      <div className="mb-6 p-3 bg-white/5 rounded-2xl w-fit group-hover:scale-110 transition">
        {icon}
      </div>
      <h3 className="text-2xl font-bold mb-4">{title}</h3>
      <p className="text-gray-400 leading-relaxed">{description}</p>
    </div>
  );
}
