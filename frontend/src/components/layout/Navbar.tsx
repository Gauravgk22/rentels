import React from 'react';
import Link from 'next/link';

const Navbar = () => {
  return (
    <nav className="fixed top-0 w-full z-50 bg-black/50 backdrop-blur-md border-b border-white/10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="flex items-center">
            <Link href="/" className="text-xl font-bold text-white tracking-tighter">
              AWISH<span className="text-red-500">RENTALS</span>
            </Link>
          </div>
          <div className="hidden md:block">
            <div className="ml-10 flex items-baseline space-x-4">
              <Link href="/properties" className="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Properties</Link>
              <Link href="/vehicles" className="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vehicles</Link>
              <Link href="/login" className="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition">Login</Link>
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
