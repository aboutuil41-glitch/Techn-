<div>

    {{-- ─── PROFILE HERO ─── --}}
    <div class="profile-hero">
        <div class="hero-body">

            {{-- Avatar + Identity --}}
            <div class="hero-top">
                <div class="avatar-wrap">
                    <div class="avatar-ring">
                        <div class="avatar-inner">
                            {{ strtoupper(substr($user->username, 0, 1)) }}
                        </div>
                    </div>
                    <div class="level-badge">{{ $user->level }}</div>
                </div>

                <div class="hero-identity">
                    <div class="hero-label">Profile</div>
                    <div class="hero-username">{{ $user->username }}</div>
                    <div class="hero-rank">
                        <span class="rank-dot"></span>
                        <span class="rank-title">{{ $user->title }}</span>
                        <span class="rank-sep"></span>
                        <span class="rank-level">Level {{ $user->level }}</span>
                    </div>
                    <div class="hero-email">{{ $user->email }}</div>
                </div>
            </div>

            {{-- XP Bar --}}
            <div class="xp-section">
                <div class="xp-row">
                    <span class="xp-label">Experience Points</span>
                    <span class="xp-numbers">
                        <strong>{{ number_format($user->xp) }}</strong> XP total
                        &nbsp;·&nbsp;
                        {{ $xpForCurrentLevel }} / {{ $xpNeededForNextLevel }} to next level
                    </span>
                </div>
                <div class="xp-track">
                    <div class="xp-fill" style="width: {{ $xpProgressPercent }}%"></div>
                </div>
                <div class="xp-next">
                    {{ round(100 - $xpProgressPercent) }}% remaining &rarr; {{ $nextTitle }}
                </div>
            </div>

        </div>
    </div>

    {{-- ─── QUICK STATS ─── --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-num">{{ $stats['lessons_done'] }}</div>
            <div class="stat-lbl">Lessons Done</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $stats['battles_joined'] }}</div>
            <div class="stat-lbl">Battles Joined</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $stats['quiz_attempts'] }}</div>
            <div class="stat-lbl">Quiz Attempts</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $stats['certificates'] }}</div>
            <div class="stat-lbl">Certificates</div>
        </div>
    </div>

    {{-- ─── MAIN GRID ─── --}}
    <div class="profile-grid">

        {{-- LEFT COLUMN --}}
        <div class="left-col">

            {{-- Learning Progress --}}
            @if($learningPaths->isNotEmpty())
            <div class="section-card">
                <div class="card-head">
                    <div class="card-eyebrow">Paths</div>
                    <div class="card-title">Learning Progress</div>
                </div>

                @foreach($learningPaths as $path)
                <div class="progress-item">
                    <div class="progress-item-top">
                        <div class="progress-item-name">
                            {{ $path['name'] }}
                            @if($path['certified'])
                                <span class="cert-chip">✓ Certified</span>
                            @endif
                        </div>
                        <span class="progress-pct">{{ $path['percent'] }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: {{ $path['percent'] }}%"></div>
                    </div>
                    <div class="progress-sub">
                        {{ $path['completed'] }} of {{ $path['total'] }} lessons complete
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Certificates --}}
            @if($certificates->isNotEmpty())
            <div class="section-card">
                <div class="card-head">
                    <div class="card-eyebrow">Achievements</div>
                    <div class="card-title">Certificates</div>
                </div>

                @foreach($certificates as $cert)
                <div class="cert-row">
                    <div class="cert-icon">✦</div>
                    <div class="cert-body">
                        <div class="cert-path">{{ $cert->learningPath->name }}</div>
                        <div class="cert-code">{{ $cert->certificate_code }}</div>
                    </div>
                    <div class="cert-date">{{ $cert->issued_at->format('M d, Y') }}</div>
                </div>
                @endforeach
            </div>
            @endif

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="right-col">

            {{-- Battle Submissions --}}
            @if($submissions->isNotEmpty())
            <div class="section-card">
                <div class="card-head">
                    <div class="card-eyebrow">Challenges</div>
                    <div class="card-title">Battle Submissions</div>
                </div>

                @foreach($submissions as $sub)
                <div class="battle-row">
                    <div class="battle-row-body">
                        <div class="battle-row-name">{{ $sub->title }}</div>
                        <div class="battle-row-meta">
                            {{ $sub->artBattle->theme }}
                            &nbsp;·&nbsp;
                            {{ $sub->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="battle-row-right">
                        <span class="likes-chip">♥ {{ $sub->like_count }}</span>
                        @if($sub->artBattle->status === 'active')
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-done">Done</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Account Details --}}
            <div class="section-card">
                <div class="card-head">
                    <div class="card-eyebrow">Account</div>
                    <div class="card-title">Details</div>
                </div>

                <div class="account-row">
                    <span class="account-lbl">Username</span>
                    <span class="account-val">{{ $user->username }}</span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Email</span>
                    <span class="account-val">{{ $user->email }}</span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Verified</span>
                    <span>
                        @if($user->email_verified_at)
                            <span class="verified-chip">✓ Verified</span>
                        @else
                            <span class="unverified-chip">Not verified</span>
                        @endif
                    </span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Level</span>
                    <span class="account-val">{{ $user->level }}</span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Title</span>
                    <span class="account-val gold">{{ $user->title }}</span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Total XP</span>
                    <span class="account-val">{{ number_format($user->xp) }}</span>
                </div>
                <div class="account-row">
                    <span class="account-lbl">Member since</span>
                    <span class="account-val muted">{{ $user->created_at->format('F Y') }}</span>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- ─── STYLES ─── --}}
@push('styles')
<style>
:root{
  --rin:#C0392B;--rin-soft:#D65F5F;--rin-pale:#FAEAEA;
  --blossom:#E8A0A8;--petal:#F0DDE0;--petal-light:#FDF0F2;
  --ink:#1C1020;--ink-mid:#4A3050;--ink-soft:#9A8090;
  --ivory:#FDFAF7;--ivory-2:#F7F0EA;
  --gold:#C4996B;--gold-light:#F0DFC8;
  --indigo:#2C2060;
}

/* ── HERO ── */
.profile-hero{
    background: linear-gradient(150deg, var(--indigo) 0%, #3D1240 55%, #5A1C3C 100%);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 1.25rem;
    position: relative;
}
.profile-hero::before{
    content: '✿';
    position: absolute; right: -10px; top: -20px;
    font-size: 240px; opacity: 0.04; color: white;
    line-height: 1; pointer-events: none;
    font-family: 'Cormorant Garamond', serif;
}
.hero-body{ padding: 2rem 2.5rem 0; position: relative; z-index: 1; }
.hero-top{ display: flex; align-items: flex-start; gap: 1.5rem; margin-bottom: 1.5rem; }

.avatar-wrap{ position: relative; flex-shrink: 0; }
.avatar-ring{
    width: 76px; height: 76px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), var(--blossom), var(--rin));
    padding: 3px;
}
.avatar-inner{
    width: 100%; height: 100%; border-radius: 50%;
    background: linear-gradient(135deg, #3D1240, var(--indigo));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 30px; font-weight: 400; color: white; font-style: italic;
}
.level-badge{
    position: absolute; bottom: -2px; right: -2px;
    width: 22px; height: 22px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), #E8B878);
    border: 2px solid #3D1240;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 600; color: white;
}

.hero-identity{ flex: 1; }
.hero-label{ font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(232,160,168,0.7); margin-bottom: 2px; }
.hero-username{ font-family: 'Cormorant Garamond', serif; font-size: 32px; font-weight: 300; color: white; line-height: 1.1; margin-bottom: 6px; }
.hero-rank{
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14);
    border-radius: 100px; padding: 4px 13px; margin-bottom: 10px;
}
.rank-dot{ width: 4px; height: 4px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }
.rank-title{ font-size: 12px; font-weight: 500; color: rgba(255,255,255,0.85); letter-spacing: 0.05em; }
.rank-sep{ width: 1px; height: 12px; background: rgba(255,255,255,0.15); }
.rank-level{ font-size: 12px; color: rgba(255,255,255,0.45); }
.hero-email{ font-size: 12px; color: rgba(255,255,255,0.35); }

/* XP */
.xp-section{
    border-top: 1px solid rgba(255,255,255,0.07);
    padding: 1.2rem 2.5rem 1.4rem;
    position: relative; z-index: 1;
}
.xp-row{ display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
.xp-label{ font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.35); }
.xp-numbers{ font-size: 12px; color: rgba(255,255,255,0.55); }
.xp-numbers strong{ color: white; font-weight: 500; }
.xp-track{ height: 4px; border-radius: 10px; background: rgba(255,255,255,0.1); overflow: hidden; }
.xp-fill{ height: 100%; border-radius: 10px; background: linear-gradient(90deg, var(--gold), #E8B878, var(--blossom)); transition: width 0.8s ease; }
.xp-next{ font-size: 11px; color: rgba(255,255,255,0.3); margin-top: 5px; text-align: right; }

/* ── STATS ── */
.stats-row{ display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 1.25rem; }
.stat-card{
    background: white; border: 1px solid var(--petal);
    border-radius: 14px; padding: 1rem 1.1rem; text-align: center;
    transition: border-color 0.2s;
}
.stat-card:hover{ border-color: var(--blossom); }
.stat-num{ font-family: 'Cormorant Garamond', serif; font-size: 34px; font-weight: 300; color: var(--ink); line-height: 1; margin-bottom: 3px; }
.stat-lbl{ font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--ink-soft); }

/* ── GRID ── */
.profile-grid{ display: grid; grid-template-columns: 1fr 320px; gap: 1.25rem; }
.left-col, .right-col{ display: flex; flex-direction: column; gap: 1.25rem; }

/* ── SECTION CARD ── */
.section-card{ background: white; border: 1px solid var(--petal); border-radius: 16px; overflow: hidden; }
.card-head{ padding: 1rem 1.4rem; border-bottom: 1px solid var(--petal); }
.card-eyebrow{ font-size: 10px; letter-spacing: 0.16em; text-transform: uppercase; color: var(--ink-soft); margin-bottom: 1px; }
.card-title{ font-family: 'Cormorant Garamond', serif; font-size: 19px; font-weight: 400; color: var(--ink); }

/* ── PROGRESS ── */
.progress-item{ padding: 0.9rem 1.4rem; border-bottom: 1px solid var(--petal-light); }
.progress-item:last-child{ border-bottom: none; }
.progress-item-top{ display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
.progress-item-name{ font-size: 13.5px; font-weight: 500; color: var(--ink); display: flex; align-items: center; gap: 8px; }
.progress-pct{ font-size: 12px; color: var(--rin); font-weight: 500; }
.progress-bar{ height: 3px; background: var(--petal); border-radius: 10px; overflow: hidden; }
.progress-bar-fill{ height: 100%; border-radius: 10px; background: linear-gradient(90deg, var(--rin), var(--blossom)); }
.progress-sub{ font-size: 11.5px; color: var(--ink-soft); margin-top: 4px; }
.cert-chip{
    font-size: 10px; background: var(--gold-light); color: #8B6020;
    border: 1px solid #E0C898; border-radius: 100px; padding: 2px 8px;
    font-weight: 400; letter-spacing: 0.03em;
}

/* ── CERTIFICATES ── */
.cert-row{ display: flex; align-items: center; gap: 12px; padding: 0.85rem 1.4rem; border-bottom: 1px solid var(--petal-light); }
.cert-row:last-child{ border-bottom: none; }
.cert-icon{
    width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0;
    background: var(--gold-light); color: #8B6020;
    display: flex; align-items: center; justify-content: center; font-size: 15px;
}
.cert-body{ flex: 1; }
.cert-path{ font-size: 13.5px; font-weight: 500; color: var(--ink); margin-bottom: 2px; }
.cert-code{ font-size: 11px; color: var(--ink-soft); letter-spacing: 0.06em; font-family: monospace; }
.cert-date{ font-size: 12px; color: var(--ink-soft); flex-shrink: 0; }

/* ── BATTLES ── */
.battle-row{ display: flex; align-items: center; gap: 12px; padding: 0.85rem 1.4rem; border-bottom: 1px solid var(--petal-light); }
.battle-row:last-child{ border-bottom: none; }
.battle-row-body{ flex: 1; min-width: 0; }
.battle-row-name{ font-size: 13.5px; font-weight: 500; color: var(--ink); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.battle-row-meta{ font-size: 12px; color: var(--ink-soft); }
.battle-row-right{ display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
.likes-chip{ font-size: 12px; color: var(--rin-soft); }
.badge-active{ font-size: 11px; background: #EBF7F1; color: #2D8A5C; border: 1px solid #A8DEC2; border-radius: 100px; padding: 3px 10px; }
.badge-done{ font-size: 11px; background: var(--ivory-2); color: var(--ink-soft); border: 1px solid var(--petal); border-radius: 100px; padding: 3px 10px; }

/* ── ACCOUNT ── */
.account-row{ display: flex; align-items: center; justify-content: space-between; padding: 0.7rem 1.4rem; border-bottom: 1px solid var(--petal-light); }
.account-row:last-child{ border-bottom: none; }
.account-lbl{ font-size: 12px; color: var(--ink-soft); }
.account-val{ font-size: 13px; font-weight: 500; color: var(--ink); }
.account-val.gold{ color: var(--gold); }
.account-val.muted{ font-weight: 400; color: var(--ink-soft); }
.verified-chip{ font-size: 11px; background: #EBF7F1; color: #2D8A5C; border: 1px solid #A8DEC2; border-radius: 100px; padding: 3px 10px; }
.unverified-chip{ font-size: 11px; background: var(--rin-pale); color: var(--rin); border: 1px solid #F0B5B5; border-radius: 100px; padding: 3px 10px; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .profile-grid{ grid-template-columns: 1fr; }
    .stats-row{ grid-template-columns: repeat(2, 1fr); }
    .hero-body{ padding: 1.5rem 1.5rem 0; }
    .xp-section{ padding: 1rem 1.5rem 1.2rem; }
    .xp-numbers{ display: none; }
}
</style>
@endpush